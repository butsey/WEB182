<?php

//set default values to be used when page first loads
$scores = array();
$scores[0] = 70;
$scores[1] = 80;
$scores[2] = 90; 
        
$scores_string = '';
$score_total = 0;
$score_average = 0;
$max_rolls = 0;
$average_rolls = 0;

//take action based on variable in POST array
$action = filter_input(INPUT_POST, 'action');
switch ($action) {
    case 'process_scores':
        $scores = $_POST['scores'];

        // validate the scores
        // TODO: Convert this if statement to a for loop
        
        for ($i= 0; $i<count($scores); $i++) {
            if (empty($scores[$i]) || !is_numeric($scores[$i])){
                $scores_string = 'You must enter three valid numbers for scores.';
                $score_total = 0;
                $score_average = 0;
                break;
            } else {
                $scores_string = '';
                foreach ($scores as $s) {
                    $scores_string .= $s . '|';
                 }
                 $scores_string = substr($scores_string, 0, strlen($scores_string)-1);

                $score_total = array_sum($scores);
                $score_average = $score_total / count($scores);
            }
        }


        break;
    case 'process_rolls':
        $number_to_roll = filter_input(INPUT_POST, 'number_to_roll', 
                FILTER_VALIDATE_INT);

        $total = 0;
        $count = 0;
        $max_rolls = -INF;

        // TODO: convert this while loop to a for loop
        
        for ($count=1; $count<1000; $count++) {
            $rolls = 1;
            while (mt_rand(1, 6) != 6) {
                $rolls++;
            }
            $total += $rolls;
            $max_rolls = max($rolls, $max_rolls);
        }
        $average_rolls = $total / $count;

        break;
}
include 'loop_tester.php';
?>