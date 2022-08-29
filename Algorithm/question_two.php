<!-- Program that creates a staircase -->
<?php
function create($n) {
    if($n >0 && $n<=100){
      for ($i = 1; $i <=$n ; $i++){
          $spaces = $n-$i;
          while ($spaces){
              echo " ";
              $spaces--;
          }
          $stairs = 0;
          while ($stairs < $i){
              echo "#";
              $stairs++;
          }
          echo "\n";
      }
    }
}
create(6);
?>

