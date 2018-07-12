<?php

namespace Dp\MainBundle\Services\Calcul;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\SecurityContext;

class Stuff
{

    /**
     * @var SecurityContext
     */
    protected $context;
    protected $em;
    protected $totalBonus;

    /**
     * @param SecurityContext $context
     */
    public function __construct($context)
    {
        $this->context = $context;
        $this->totalBonus = array();
    }

    public function setEntityManager(ObjectManager $em)
    {
       $this->em = $em;
    }

    /**
     * [Pr chaque item on check si il est dans une pano. Si oui on regarde notre array, si il y a déjà une entrée pr la pano on ajoute un niveau de bonus, sinon on ajoute dans l'array.]
     * @param  [type] $stuffdetails [description]
     * @return [type]      [description]
     */
    public function getBonusPanoply($stuffdetails)
    {
        $panoply = array();
        foreach ($stuffdetails as $key => $sd) {
            if($sd->getItem() != NULL && $sd->getItem()->getPanoply() != NULL && !array_key_exists($sd->getItem()->getPanoply()->getId(), $panoply)) {
                $panoply[$sd->getItem()->getPanoply()->getId()] = 1;
            }
            else if($sd->getItem() != NULL && $sd->getItem()->getPanoply() != NULL && array_key_exists($sd->getItem()->getPanoply()->getId(), $panoply)) {
                $panoply[$sd->getItem()->getPanoply()->getId()]++;
            }
        }

        $bonus = array();
        $bonuspanoplyRepository = $this->em->getRepository('DpMainBundle:bonuspanoply');

        foreach ($panoply as $id => $nb) {
            foreach ($bonuspanoplyRepository->findBy(array('panoply' => $id, 'bonuscount' => $nb)) as $b) {
                if($b->getEffecttype()->getName() != NULL && !array_key_exists($b->getEffecttype()->getName(), $bonus)) {
                    $bonus[$b->getEffecttype()->getName()] = array('min' => $b->getValuemin(), 'max' => $b->getValuemax());
                }
                else if($b->getEffecttype()->getName() != NULL && array_key_exists($b->getEffecttype()->getName(), $bonus)) {
                    $bonus[$b->getEffecttype()->getName()] = array(
                                                                  'min' => $bonus[$b->getEffecttype()->getName()]['min']+$b->getValuemin(),
                                                                  'max' => $bonus[$b->getEffecttype()->getName()]['max']+$b->getValuemax()
                                                                  );
                }
            }
        }
        return $bonus;
    }

    /**
     * [mergeCharacteristics pour mettre tout les carac dans un seul même champ (agi=>, force=>, pa=>, etc)]
     * @param  [type] $stuffdetails [description]
     * @return [type]               [description]
     */
    public function mergeCharacteristics($stuffdetails)
    {

      $bonus = array();

      foreach ($stuffdetails as $key => $sd) {
        foreach($sd->getItem()->getEffects() as $ic) {
          if($ic->getEffecttype() != NULL && !array_key_exists($ic->getEffecttype()->getName(), $bonus)) {
                $bonus[$ic->getEffecttype()->getName()] = array('min' => $ic->getValuemin(), 'max' => $ic->getValuemax());
          }
          else if($ic->getEffecttype() != NULL && array_key_exists($ic->getEffecttype()->getName(), $bonus)) {
                $bonus[$ic->getEffecttype()->getName()] = array(
                                                                  'min' => $bonus[$ic->getEffecttype()->getName()]['min']+$ic->getValuemin(),
                                                                  'max' => $bonus[$ic->getEffecttype()->getName()]['max']+$ic->getValuemax()
                                                                );
          }
        }
        if($sd->getOvertype() != NULL && !array_key_exists($sd->getOvertype(), $bonus)) {
              $bonus[$sd->getOvertype()] = array('min' => 1, 'max' => 1);
        }
        else if($sd->getOvertype() != NULL && array_key_exists($sd->getOvertype(), $bonus)) {
              $bonus[$sd->getOvertype()] = array(
                                                  'min' => $bonus[$sd->getOvertype()]['min']+1,
                                                  'max' => $bonus[$sd->getOvertype()]['max']+1
                                                );
        }
      }
      return $bonus;
    }


    public function mergeStuffCharacteristics($stuffcharacteristics)
    {

      $bonus = array();

      foreach ($stuffcharacteristics as $key => $sc) {
          if($sc->getEffecttype() != NULL && !array_key_exists($sc->getEffecttype()->getName(), $bonus)) {
                $bonus[$sc->getEffecttype()->getName()] = array('min' => $sc->getValue(), 'max' => $sc->getValue());
          }
          else if($sc->getEffecttype() != NULL && array_key_exists($sc->getEffecttype()->getName(), $bonus)) {
                $bonus[$sc->getEffecttype()->getName()] =
                  array(
                    'min' => $bonus[$sc->getEffecttype()->getName()]['min']+$sc->getValue(),
                    'max' => $bonus[$sc->getEffecttype()->getName()]['max']+$sc->getValue()
                  );
          }
      }
      return $bonus;
    }

    /**
     * [getTotalCharacteristics y'a du brain ! pour chaque array on merge tout]
     * @param  [type] $tab [description]
     * @return [type]      [description]
     */
    public function getTotalCharacteristics($tab) {

      foreach ($tab as $value) {
        foreach ($value as $key => $array) {
          if(array_key_exists($key, $this->totalBonus)) {
            $this->totalBonus[$key] = array(
                                        'min' => $this->totalBonus[$key]['min'] + $array['min'],
                                        'max' => $this->totalBonus[$key]['max'] + $array['max']
                                      );
          }
          else{
            $this->totalBonus[$key] = array(
                                        'min' => $array['min'],
                                        'max' => $array['max']
                                      );
          }
        }
      }

      $this->setInitiative();
      $this->setProspection();
      $this->setFuiteEtTacle();
      $this->setEsquiveEtRetrait();

      return $this->totalBonus;
    }

    public function setInitiative(){
      $iniBaseMin = !empty($this->totalBonus['Initiative']['min']) ? $this->totalBonus['Initiative']['min'] : 0;
      $iniBaseMax = !empty($this->totalBonus['Initiative']['max']) ? $this->totalBonus['Initiative']['max'] : 0;

      $forceBaseMin = !empty($this->totalBonus['Force']['min']) ? $this->totalBonus['Force']['min'] : 0;
      $forceBaseMax = !empty($this->totalBonus['Force']['max']) ? $this->totalBonus['Force']['max'] : 0;
      $chanceBaseMin = !empty($this->totalBonus['Chance']['min']) ? $this->totalBonus['Chance']['min'] : 0;
      $chanceBaseMax = !empty($this->totalBonus['Chance']['max']) ? $this->totalBonus['Chance']['max'] : 0;
      $intelBaseMin = !empty($this->totalBonus['Intelligence']['min']) ? $this->totalBonus['Intelligence']['min'] : 0;
      $intelBaseMax = !empty($this->totalBonus['Intelligence']['max']) ? $this->totalBonus['Intelligence']['max'] : 0;
      $agiBaseMin = !empty($this->totalBonus['Agilité']['min']) ? $this->totalBonus['Agilité']['min'] : 0;
      $agiBaseMax = !empty($this->totalBonus['Agilité']['max']) ? $this->totalBonus['Agilité']['max'] : 0;

      $iniTotalMin = $iniBaseMin+$forceBaseMin+$chanceBaseMin+$intelBaseMin+$agiBaseMin;
      $iniTotalMax = $iniBaseMax+$forceBaseMax+$chanceBaseMax+$intelBaseMax+$agiBaseMax;

      $this->totalBonus['Initiative']['min'] = (int)$iniTotalMin;
      $this->totalBonus['Initiative']['max'] = (int)$iniTotalMax;
    }

    public function setProspection(){
      //De base les persos possèdent 100PP, les enus aussi depuis une maj en 2013
      $basePp = 100;

      $ppBaseMin = !empty($this->totalBonus['Prospection']['min']) ? $this->totalBonus['Prospection']['min'] : 0;
      $ppBaseMax = !empty($this->totalBonus['Prospection']['max']) ? $this->totalBonus['Prospection']['max'] : 0;

      $chanceBaseMin = !empty($this->totalBonus['Chance']['min']) ? $this->totalBonus['Chance']['min'] : 0;
      $chanceBaseMax = !empty($this->totalBonus['Chance']['max']) ? $this->totalBonus['Chance']['max'] : 0;

      $ppTotalMin = $basePp+$ppBaseMin+($chanceBaseMin/10);
      $ppTotalMax = $basePp+$ppBaseMax+($chanceBaseMax/10);

      $this->totalBonus['Prospection']['min'] = (int)$ppTotalMin;
      $this->totalBonus['Prospection']['max'] = (int)$ppTotalMax;
    }

    public function setFuiteEtTacle(){
      $agiBaseMin = !empty($this->totalBonus['Agilité']['min']) ? $this->totalBonus['Agilité']['min'] : 0;
      $agiBaseMax = !empty($this->totalBonus['Agilité']['max']) ? $this->totalBonus['Agilité']['max'] : 0;

      $tacleBaseMin = !empty($this->totalBonus['Tacle']['min']) ? $this->totalBonus['Tacle']['min'] : 0;
      $tacleBaseMax = !empty($this->totalBonus['Tacle']['max']) ? $this->totalBonus['Tacle']['max'] : 0;

      $fuiteBaseMin = !empty($this->totalBonus['Fuite']['min']) ? $this->totalBonus['Fuite']['min'] : 0;
      $fuiteBaseMax = !empty($this->totalBonus['Fuite']['max']) ? $this->totalBonus['Fuite']['max'] : 0;

      $tacleTotalMin = $tacleBaseMin+($agiBaseMin/10);
      $tacleTotalMax = $tacleBaseMax+($agiBaseMax/10);

      $fuiteTotalMin = $fuiteBaseMin+($agiBaseMin/10);
      $fuiteTotalMax = $fuiteBaseMax+($agiBaseMax/10);

      $this->totalBonus['Tacle']['min'] = (int)$tacleTotalMin;
      $this->totalBonus['Tacle']['max'] = (int)$tacleTotalMax;

      $this->totalBonus['Fuite']['min'] = (int)$fuiteTotalMin;
      $this->totalBonus['Fuite']['max'] = (int)$fuiteTotalMax;
    }

    public function setEsquiveEtRetrait(){
      $sagesseBaseMin = !empty($this->totalBonus['Sagesse']['min']) ? $this->totalBonus['Sagesse']['min'] : 0;
      $sagesseBaseMax = !empty($this->totalBonus['Sagesse']['max']) ? $this->totalBonus['Sagesse']['max'] : 0;

      $esquivePaBaseMin = !empty($this->totalBonus['Esquive PA']['min']) ? $this->totalBonus['Esquive PA']['min'] : 0;
      $esquivePaBaseMax = !empty($this->totalBonus['Esquive PA']['max']) ? $this->totalBonus['Esquive PA']['max'] : 0;

      $esquivePmBaseMin = !empty($this->totalBonus['Esquive PM']['min']) ? $this->totalBonus['Esquive PM']['min'] : 0;
      $esquivePmBaseMax = !empty($this->totalBonus['Esquive PM']['max']) ? $this->totalBonus['Esquive PM']['max'] : 0;

      $retraitPaBaseMin = !empty($this->totalBonus['Retrait PA']['min']) ? $this->totalBonus['Retrait PA']['min'] : 0;
      $retraitPaBaseMax = !empty($this->totalBonus['Retrait PA']['max']) ? $this->totalBonus['Retrait PA']['max'] : 0;

      $retraitPmBaseMin = !empty($this->totalBonus['Retrait PM']['min']) ? $this->totalBonus['Retrait PM']['min'] : 0;
      $retraitPmBaseMax = !empty($this->totalBonus['Retrait PM']['max']) ? $this->totalBonus['Retrait PM']['max'] : 0;

      $bonusBaseMin = $sagesseBaseMin/10;
      $bonusBaseMax = $sagesseBaseMax/10;

      $esquivePaTotalMin = $esquivePaBaseMin+$bonusBaseMin;
      $esquivePaTotalMax = $esquivePaBaseMax+$bonusBaseMax;

      $esquivePmTotalMin = $esquivePmBaseMin+$bonusBaseMin;
      $esquivePmTotalMax = $esquivePmBaseMax+$bonusBaseMax;

      $retraitPaTotalMin = $retraitPaBaseMin+$bonusBaseMin;
      $retraitPaTotalMax = $retraitPaBaseMax+$bonusBaseMax;

      $retraitPmTotalMin = $retraitPmBaseMin+$bonusBaseMin;
      $retraitPmTotalMax = $retraitPmBaseMax+$bonusBaseMax;

      $this->totalBonus['Esquive PA']['min'] = (int)$esquivePaTotalMin;
      $this->totalBonus['Esquive PA']['max'] = (int)$esquivePaTotalMax;

      $this->totalBonus['Esquive PM']['min'] = (int)$esquivePmTotalMin;
      $this->totalBonus['Esquive PM']['max'] = (int)$esquivePmTotalMax;

      $this->totalBonus['Retrait PA']['min'] = (int)$retraitPaTotalMin;
      $this->totalBonus['Retrait PA']['max'] = (int)$retraitPaTotalMax;

      $this->totalBonus['Retrait PM']['min'] = (int)$retraitPmTotalMin;
      $this->totalBonus['Retrait PM']['max'] = (int)$retraitPmTotalMax;
    }

}