<?php
/**
 * the TriRunProvider provides triathlon-specific run workouts
 * @author clemens
 */
class TriRunProvider extends WorkoutProvider {
	
	protected $SPORT = 'RUN';
	
	/**
	 * (non-PHPdoc)
	 * @see WorkoutProvider::generateLSDWorkout()
	 */
	protected function generateLSDWorkout(Race $ldRace) {

		$duration = 0;

		if ( isset( RunWorkout::$LSD_TIMES[$this->athlete->getLevel()][$ldRace->getWeeksTillRaceday($this->generateWeek)] ) )
				$duration = RunWorkout::$LSD_TIMES[$this->athlete->getLevel()][$ldRace->getWeeksTillRaceday($this->generateWeek)];

		if ($duration == 0) {
			return false;
		}

		return new RunWorkout($this->athlete, Workout::E2, $duration, true);
	}

	/**
	 * (non-PHPdoc)
	 * @see WorkoutProvider::generateTestWorkout()
	 */
	protected function generateTestWorkout() {
		$ldRace = $this->athlete->getSchedule()->getNextLDRace($this->generateWeek);

		// if the athlete got a long distance race defined
		// we let him do long test workouts
		if ($ldRace) {
			return new RunWorkout($this->athlete, Workout::TEST_LONG, 60);
		} else {
			return new RunWorkout($this->athlete, Workout::TEST_SHORT, 30);
		}
	}
	
	/**
	 * (non-PHPdoc)
	 * @see WorkoutProvider::getWorkoutTypeSequence()
	 */
	protected function getWorkoutTypeSequence(Database $DB, $phase, Athlete $athlete, DateTime $week) {
		return new TriRunWorkoutTypeSequence(
			$this->DB, $this->phase["phase"], $this->athlete, $week);
	}
	
	/**
	 * (non-PHPdoc)
	 * @see WorkoutProvider::newWorkout()
	 */
	protected function newWorkout($type, $duration, $lsd=false) {
		return new RunWorkout($this->athlete, $type, $duration, $lsd);
	}
	
	/**
	 * (non-PHPdoc)
	 * @see WorkoutProvider::getDuration()
	 */
	protected function getDuration($trainingType, $raceType) {
		// the determined duration
		$d = -1;
		$distance = Race::getDistanceClass($raceType);
		switch($trainingType) {
			case "E1":
				switch($distance) {
					case "SPRINT":
						$d = 30;
						break;
					case "SHORT";
						$d = 40;
						break;
					case "MIDDLE":
						$d = 60;
						break;
					case "LONG":
						$d = 75;
						break;
				}
				break;
			case "E2":
			case "S2":
				switch($distance) {
					case "SPRINT":
						$d = 45;
						break;
					case "SHORT";
						$d = 60;
						break;
					case "MIDDLE":
						$d = 75;
						break;
					case "LONG":
						$d = 90;
						break;
				}
				break;
			case "E3":
				switch($distance) {
					case "SPRINT":
						$d = 30;
						break;
					case "SHORT";
						$d = 40;
						break;
					case "MIDDLE":
						$d = 65;
						break;
					case "LONG":
						$d = 90;
						break;
				}
				break;
			case "F1":
			case "F2":
				switch($distance) {
					case "SPRINT":
						$d = 30;
						break;
					case "SHORT";
						$d = 45;
						break;
					case "MIDDLE":
						$d = 60;
						break;
					case "LONG":
						$d = 80;
						break;
				}
				break;
			case "F3":
				switch($distance) {
					case "SPRINT":
						$d = 30;
						break;
					case "SHORT";
						$d = 40;
						break;
					case "MIDDLE":
						$d = 60;
						break;
					case "LONG":
						$d = 80;
						break;
				}
				break;
			case "S1":
				switch($distance) {
					case "SPRINT":
						$d = 30;
						break;
					case "SHORT";
						$d = 45;
						break;
					case "MIDDLE":
						$d = 60;
						break;
					case "LONG":
						$d = 80;
						break;
				}
				break;
			case "M1":
			case "M2":
			case "M3":
			case "M4":
				switch($distance) {
					case "SPRINT":
						$d = 30;
						break;
					case "SHORT";
						$d = 45;
						break;
					case "MIDDLE":
						$d = 65;
						break;
					case "LONG":
						$d = 90;
						break;
				}
				break;
			case "M5":
				switch($distance) {
					case "SPRINT":
						$d = 30;
						break;
					case "SHORT";
						$d = 40;
						break;
					case "MIDDLE":
						$d = 60;
						break;
					case "LONG":
						$d = 80;
						break;
				}
				break;

		}

		// apply modificator past trainings
		$m = $this->getModificator($trainingType);
		$d = $d * $m;
		
		// TODO apply personal modificator for this kind of training

		// check if we've got a duration or if there is a typo in the spec above
		if ($d == -1) {
			throw new Exception("Could not determine training duration for training type " .
				"{$trainingType}, race type {$raceType}, distance {$distance}");
		}

		// round to nearest five
		$d = round($d / 5) * 5;
		return $d;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see WorkoutProvider::isSportMatching()
	 */
	protected function isSportMatching(Race $race) {
		$t = substr($race->getType(), 0, 3);
		if ($t === 'RUN' || $t === 'TRI') {
			return true;
		} else {
			return false;
		}
	}
}
?>