<?php

namespace Dp\MainBundle\Services\Import;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\SecurityContext;
use Dp\MainBundle\Entity\Stuff;
use Dp\MainBundle\Entity\Stuffdetail;
use Dp\MainBundle\Entity\Stuffcharacteristic;

class Dofusbook
{

    /**
     * @var SecurityContext
     */
    protected $context;

    protected $twigDpExtension;

    /**
     * @param SecurityContext $context
     */
    public function __construct(SecurityContext $context, $twigDpExtension)
    {
        $this->context = $context;
        $this->twigDpExtension = $twigDpExtension;
    }

    protected $em;

    public function setEntityManager(ObjectManager $em)
    {
       $this->em = $em;
    }

    /**
     * [getAllEquipment description]
     * @param  [type] $url [description]
     * @return [type]      [description]
     */
    public function getAllEquipment($url)
    {
        //http://www.dofusbook.net/fr/personnage/fiche/612-symfony/1.html

        // Url de dofusbook ?
        if(!preg_match("/dofusbook.net\/.*/", $url))
            return array("error" => "import.error.url.not_db");

        //Chargement de la page
        $c = curl_init($url);
        curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($c, CURLOPT_COOKIEJAR, 'monCookie.txt');
        curl_setopt($c, CURLOPT_TIMEOUT, 10);
        curl_setopt($c, CURLOPT_FOLLOWLOCATION, true);

        $pageContent = curl_exec($c);

        if (curl_error($c)){
            return array("error" => "import.error.base");
        }

        $status = curl_getinfo($c, CURLINFO_HTTP_CODE);

        curl_close($c);

        $itemHtml = new \DOMDocument();
        @$itemHtml->loadHTML($pageContent);

        if($itemHtml->textContent != 1){

            $itemObj = new \DomXPath($itemHtml);
            $itemTitle = $itemObj->query("//title");

            //Pas une 404 ?
            if(preg_match("/Dofus-Book : rôooo impossible de trouver la page/", $itemTitle->item(0)->nodeValue))
                return array("error" => "import.error.url.error");

            //Perso confidentiel ou introuvable ?
            $testConfidential = $itemObj->query("//div[@id='ajax']//div[contains(@class, 'global-speach')]//h2");
            if(isset($testConfidential->item(0)->nodeValue) && preg_match("/^Oups.../", $testConfidential->item(0)->nodeValue))
                return array("error" => "import.error.url.confidential");

            //Type de perso, lvl, nom
            $stuffName = $itemObj->query("//div[@id='ajax']//div[contains(@class, 'global-speach')]//h2//span[contains(@class, 'orange')]")->item(0)->nodeValue;
            $stuffInfo = $itemObj->query("//div[@id='ajax']//div[contains(@class, 'global-speach')]//div[contains(@class, 'milieu')][1]//span[not(contains(@class, 'bold'))]")->item(0)->nodeValue;
            $stuffInfo = $this->twigDpExtension->nettoyage_accent($stuffInfo);
            preg_match("/\d{1,}/", $stuffInfo, $stuffLvl);
            preg_match("/\w*/", $stuffInfo, $stuffClasse);

            $stuffLvl = $stuffLvl[0];
            $stuffClasse = $stuffClasse[0];
            
            //recup les infos
            $itemContent = $itemObj->query("//div[@id='global']//div[@id='contenu-centre']//div[@id='ajax']//div[contains(@class, 'relative')]//div[1]//form");

            $equipmentId = array();
            $exoPA = NULL;
            $exoPM = NULL;
            $exoPO = NULL;

            for($i = 0; $i < ($itemContent->length); $i++) {
                $equipment = $itemObj->evaluate(".//div[contains(@class, 'item')]/@id", $itemContent->item($i));
                preg_match("/\d+/", $equipment->item(0)->nodeValue, $eq);
                $equipmentId[] = $eq[0];
                $exo = $itemObj->evaluate("./preceding-sibling::a[position()=1]//img[contains(@class, 'inv-ok')]/@class", $itemContent->item($i));
                if(preg_match("/inv-pa/", $exo->item(0)->nodeValue))
                    $exoPA = $eq[0];
                else if(preg_match("/inv-pm/", $exo->item(0)->nodeValue))
                    $exoPM = $eq[0];
                else if(preg_match("/inv-po/", $exo->item(0)->nodeValue))
                    $exoPO = $eq[0];
            }

            //Enregistrement dans une table stuff
            $stuff = new Stuff();
            $classeRepository = $this->em
                                     ->getRepository('DpMainBundle:classe');

            $classe = $classeRepository->getOneByNameWithoutAccent(mb_strtoupper($stuffClasse));

            $stuffTitle = '['.$classe->getName().' '.$stuffLvl.'] '.$stuffName;

            $user = $this->context->getToken()->getUser();

            $stuff->setUser($user);
            $stuff->setLvl($stuffLvl);
            $stuff->setClasse($classe);
            $stuff->setName($stuffTitle);

            $this->em->persist($stuff);
            $this->em->flush();

            $itemRepository = $this->em
                                   ->getRepository('DpMainBundle:item');

            foreach ($equipmentId as $key => $value) {

                $stuffdetail = new Stuffdetail();
                $stuffdetail->setItem($itemRepository->find($value));

                $stuffdetail->setStuff($stuff);

                if($exoPA == $value)
                    $stuffdetail->setOvertype('PA');
                else if($exoPM == $value)
                    $stuffdetail->setOvertype('PM');
                else if($exoPO == $value)
                    $stuffdetail->setOvertype('PO');

                $this->em->persist($stuffdetail);
            }

            $this->em->flush();

            //les parcho et les pts naturels
            $stuffcharacteristictypeRepository = $this->em
                                                      ->getRepository('DpMainBundle:stuffcharacteristictype');

            $effecttypeRepository = $this->em
                                         ->getRepository('DpMainBundle:effecttype');


            $stuffcharacteristictype = $stuffcharacteristictypeRepository->findOneBy(array('type' => 'Naturel'));
            $effecttype = $effecttypeRepository->findOneBy(array('name' => 'Vitalité'));

            $stuffcharacteristic = new Stuffcharacteristic();
            $stuffcharacteristic->setStuff($stuff);
            $stuffcharacteristic->setstuffcharacteristictype($stuffcharacteristictype);
            $stuffcharacteristic->setEffecttype($effecttype);
            $stuffcharacteristic->setValue($itemObj->query("//table[contains(@class, 'caracs')]//tr[position()=2]//td[position()=3]")->item(0)->nodeValue);

            $this->em->persist($stuffcharacteristic);

            $effecttype = $effecttypeRepository->findOneBy(array('name' => 'Sagesse'));

            $stuffcharacteristic = new Stuffcharacteristic();
            $stuffcharacteristic->setStuff($stuff);
            $stuffcharacteristic->setstuffcharacteristictype($stuffcharacteristictype);
            $stuffcharacteristic->setEffecttype($effecttype);
            $stuffcharacteristic->setValue($itemObj->query("//table[contains(@class, 'caracs')]//tr[position()=3]//td[position()=3]")->item(0)->nodeValue);

            $this->em->persist($stuffcharacteristic);

            $effecttype = $effecttypeRepository->findOneBy(array('name' => 'Force'));

            $stuffcharacteristic = new Stuffcharacteristic();
            $stuffcharacteristic->setStuff($stuff);
            $stuffcharacteristic->setstuffcharacteristictype($stuffcharacteristictype);
            $stuffcharacteristic->setEffecttype($effecttype);
            $stuffcharacteristic->setValue($itemObj->query("//table[contains(@class, 'caracs')]//tr[position()=4]//td[position()=3]")->item(0)->nodeValue);

            $this->em->persist($stuffcharacteristic);

            $effecttype = $effecttypeRepository->findOneBy(array('name' => 'Intelligence'));

            $stuffcharacteristic = new Stuffcharacteristic();
            $stuffcharacteristic->setStuff($stuff);
            $stuffcharacteristic->setstuffcharacteristictype($stuffcharacteristictype);
            $stuffcharacteristic->setEffecttype($effecttype);
            $stuffcharacteristic->setValue($itemObj->query("//table[contains(@class, 'caracs')]//tr[position()=5]//td[position()=3]")->item(0)->nodeValue);

            $this->em->persist($stuffcharacteristic);

            $effecttype = $effecttypeRepository->findOneBy(array('name' => 'Chance'));

            $stuffcharacteristic = new Stuffcharacteristic();
            $stuffcharacteristic->setStuff($stuff);
            $stuffcharacteristic->setstuffcharacteristictype($stuffcharacteristictype);
            $stuffcharacteristic->setEffecttype($effecttype);
            $stuffcharacteristic->setValue($itemObj->query("//table[contains(@class, 'caracs')]//tr[position()=6]//td[position()=3]")->item(0)->nodeValue);

            $this->em->persist($stuffcharacteristic);

            $effecttype = $effecttypeRepository->findOneBy(array('name' => 'Agilité'));

            $stuffcharacteristic = new Stuffcharacteristic();
            $stuffcharacteristic->setStuff($stuff);
            $stuffcharacteristic->setstuffcharacteristictype($stuffcharacteristictype);
            $stuffcharacteristic->setEffecttype($effecttype);
            $stuffcharacteristic->setValue($itemObj->query("//table[contains(@class, 'caracs')]//tr[position()=7]//td[position()=3]")->item(0)->nodeValue);

            $this->em->persist($stuffcharacteristic);

            $stuffcharacteristictype = $stuffcharacteristictypeRepository->findOneBy(array('type' => 'Parchemin'));
            $effecttype = $effecttypeRepository->findOneBy(array('name' => 'Vitalité'));

            $stuffcharacteristic = new Stuffcharacteristic();
            $stuffcharacteristic->setStuff($stuff);
            $stuffcharacteristic->setstuffcharacteristictype($stuffcharacteristictype);
            $stuffcharacteristic->setEffecttype($effecttype);
            $stuffcharacteristic->setValue($itemObj->query("//table[contains(@class, 'caracs')]//tr[position()=2]//td[position()=4]")->item(0)->nodeValue);

            $this->em->persist($stuffcharacteristic);

            $effecttype = $effecttypeRepository->findOneBy(array('name' => 'Sagesse'));

            $stuffcharacteristic = new Stuffcharacteristic();
            $stuffcharacteristic->setStuff($stuff);
            $stuffcharacteristic->setstuffcharacteristictype($stuffcharacteristictype);
            $stuffcharacteristic->setEffecttype($effecttype);
            $stuffcharacteristic->setValue($itemObj->query("//table[contains(@class, 'caracs')]//tr[position()=3]//td[position()=4]")->item(0)->nodeValue);

            $this->em->persist($stuffcharacteristic);

            $effecttype = $effecttypeRepository->findOneBy(array('name' => 'Force'));

            $stuffcharacteristic = new Stuffcharacteristic();
            $stuffcharacteristic->setStuff($stuff);
            $stuffcharacteristic->setstuffcharacteristictype($stuffcharacteristictype);
            $stuffcharacteristic->setEffecttype($effecttype);
            $stuffcharacteristic->setValue($itemObj->query("//table[contains(@class, 'caracs')]//tr[position()=4]//td[position()=4]")->item(0)->nodeValue);

            $this->em->persist($stuffcharacteristic);

            $effecttype = $effecttypeRepository->findOneBy(array('name' => 'Intelligence'));

            $stuffcharacteristic = new Stuffcharacteristic();
            $stuffcharacteristic->setStuff($stuff);
            $stuffcharacteristic->setstuffcharacteristictype($stuffcharacteristictype);
            $stuffcharacteristic->setEffecttype($effecttype);
            $stuffcharacteristic->setValue($itemObj->query("//table[contains(@class, 'caracs')]//tr[position()=5]//td[position()=4]")->item(0)->nodeValue);

            $this->em->persist($stuffcharacteristic);

            $effecttype = $effecttypeRepository->findOneBy(array('name' => 'Chance'));

            $stuffcharacteristic = new Stuffcharacteristic();
            $stuffcharacteristic->setStuff($stuff);
            $stuffcharacteristic->setstuffcharacteristictype($stuffcharacteristictype);
            $stuffcharacteristic->setEffecttype($effecttype);
            $stuffcharacteristic->setValue($itemObj->query("//table[contains(@class, 'caracs')]//tr[position()=6]//td[position()=4]")->item(0)->nodeValue);

            $this->em->persist($stuffcharacteristic);

            $effecttype = $effecttypeRepository->findOneBy(array('name' => 'Agilité'));

            $stuffcharacteristic = new Stuffcharacteristic();
            $stuffcharacteristic->setStuff($stuff);
            $stuffcharacteristic->setstuffcharacteristictype($stuffcharacteristictype);
            $stuffcharacteristic->setEffecttype($effecttype);
            $stuffcharacteristic->setValue($itemObj->query("//table[contains(@class, 'caracs')]//tr[position()=7]//td[position()=4]")->item(0)->nodeValue);

            $this->em->persist($stuffcharacteristic);

            $this->em->flush();

            return array("success" => "import.success", "stuffId" => $stuff->getId());

        }
        else{
            return array("error" => "import.error.url.invalid");
        }
    }
}
