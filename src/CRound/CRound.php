<?php

/**
 * CRound contains rounds properties and methods. 
 *
 * @author Åsa Forss
 */
class CRound {
  /**
   * Properties
   *
   */
  private $rounds;
  private $scores;
  private $total;
  
  /**
   * Constructor
   *
   */
  public function __construct() {
    $this->rounds=0;
    $this->scores=0;
    $this->total=0;
 
  }
   /**
   * Mehod that gets the score of the current round
   *
   */
  public function GetScores(){
        return $this->scores;
  }
   /**
   * Method that gets the number of rounds played
   *
   */
  public function GetRounds(){
        return $this->rounds;
  }
   /**
   * Method that gets the total number of points saved
   *
   */
   public function GetTotal(){
        return $this->total;
  }
   /**
   * Method that increases $rounds with 1
   *
   */
  public function IncreaseRounds(){
      $this->rounds++;
  }
   /**
   * Method that increases score with a given number
   *
   */
  public function IncreaseScores($number){
      $this->scores+=$number;
  }
   /**
   * Method that increases the total saved number of points
   * with the current score.
   *
   */
  public function IncreaseTotal(){
      $this->total+=$this->scores;
  }
   /**
   * Method that resets the score to 0
   *
   */
  public function ResetScore(){
      $this->scores=0;
     
  }
   /**
   * Method that resets the total to 0
   *
   */
   public function ResetTotal(){
      $this->total=0;
     
  }
    
}

?>
