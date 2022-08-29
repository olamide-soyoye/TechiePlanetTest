<!-- Program to remove duplicates from each row of the n-dimensional array -->
<?php
$sample = [[1, 3, 1, 2, 3,4, 4, 3, 5],[1, 1, 1, 1, 1, 1, 1]];

function changeDuplicate($input)
{
  $newArr=$input;
  foreach ($input as $key => $value) {
    $curEle=[];
    
    foreach ($value as $key1 => $value1) {
      $curEle[]=$value1;
      if($key1==0) continue;

      $miniCount=0;
      for ($i=0; $i < count($curEle); $i++) { 
        if($curEle[$i] == $value1) {
          $miniCount++;
        }
      }
      if($miniCount > 1) $newArr[$key][$key1]=0;
    }
  }
  return $newArr;
}
echo "<pre/>";
print_r(changeDuplicate($sample));















?>