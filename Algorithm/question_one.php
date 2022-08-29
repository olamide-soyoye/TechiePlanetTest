<!-- Program that prints time in words. -->
<?php
function convert($hour, $minutes)
{
    $min_in_words = [
        "zero", "one", "two", "three", "four","five", "six", "seven", "eight", "nine",
        "ten", "eleven", "twelve", "thirteen","fourteen", "fifteen", "sixteen", "seventeen",
        "eighteen", "nineteen", "twenty", "twenty one","twenty two", "twenty three", "twenty four",
        "twenty five", "twenty six", "twenty seven","twenty eight", "twenty nine"
    ];
 
    if ($minutes == 0){
        echo $min_in_words[$hour],
        "o' clock\n" ;
    }else if ($minutes == 1){
        echo "one minute past ",
        $min_in_words[$hour], "\n";
    }else if ($minutes == 59){
        echo "one minute to ",
        $min_in_words[($hour % 12) + 1], "\n";
    }else if ($minutes == 15){
        echo "quarter past ",
        $min_in_words[$hour], "\n";
    }else if ($minutes == 30){
        echo "half past ",
        $min_in_words[$hour],"\n";
    }else if ($minutes == 45){
        echo "quarter to ",
        ($min_in_words[($hour % 12) + 1]), "\n";
    }else if ($minutes <= 30){
        echo $min_in_words[$minutes],
        " minutes past ",
        $min_in_words[$hour],"\n";
    }else if ($minutes > 30){
        echo $min_in_words[60 - $minutes],
             " minutes to ",
             $min_in_words[($hour % 12) + 1], "\n";
    }else{
        echo"Please enter a valid time!";
    }
}

convert(5, 47);
?>

