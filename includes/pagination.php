<?php
$adjacents = "2";
$prev = $page - 1;
$next = $page + 1;
$lastpage = $number_of_page;
$lpm1 = $lastpage - 1;

$pagination = "";
$pagination .= "<div class='pagination pagination-centered'>";
$pagination .= "<ul>";
if ($page==1) {
  $pagination .= "<li class='active'><a href='#'>Đầu</a></li>";
  $pagination .= "<li class='active'><a href='#' rel='tooltip' title='Trang trước'>«</a></li>";
} else {
  $pagination .= "<li><a onclick='changecomment({$id},1)'>Đầu</a></li>";
  $pagination .= "<li><a onclick='changecomment({$id},{$prev})' rel='tooltip' title='Trang trước'>«</a></li>";
}
if ($lastpage < 7 + ($adjacents * 2)) {
  for ($counter = 1; $counter <= $lastpage; $counter++) {
  	if ($counter == $page) {
  		$pagination.= "<li class='active'><a>$counter</a></li>";
    } else {
  		$pagination.= "<li><a onclick='changecomment({$id},{$counter})'>$counter</a></li>";
    }
  }
} elseif ($lastpage > 5 + ($adjacents * 2)) {
  if ($page < 1 + ($adjacents * 2)) {
    for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++) {
      if ($counter == $page) {
			  $pagination.= "<li class='active'><a>$counter</a></li>";
      } else {
			  $pagination.= "<li><a onclick='changecomment({$id},{$counter})'>$counter</a></li>";
      }
	  }
    $pagination.= "<li class='active'><a>...</a></li>";
    $pagination.= "<li><a onclick='changecomment({$id},{$lpm1})'>$lpm1</a></li>";
	  $pagination.= "<li><a onclick='changecomment({$id},{$lastpage})>$lastpage</a></li>";
  } elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2)) {
    $pagination.= "<li><a onclick='changecomment({$id},1)'>1</a></li>";
	  $pagination.= "<li><a onclick='changecomment({$id},2)'>2</a></li>";
	  $pagination.= "<li class='active'><a>...</a></li>";
	  for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++) {
		  if ($counter == $page) {
			  $pagination.= "<li class='active'><a>$counter</a></li>";
      } else {
			  $pagination.= "<li><a onclick='changecomment({$id},{$counter})'>$counter</a></li>";
      }
	  }
	  $pagination.= "<li class='active'><a>...</a></li>";
	  $pagination.= "<li><a onclick='changecomment({$id},{$lpm1})'>$lpm1</a></li>";
	  $pagination.= "<li><a onclick='changecomment({$id},{$lastpage})'>$lastpage</a></li>";
  } else {
	  $pagination.= "<li><a onclick='changecomment({$id},1)'>1</a></li>";
	  $pagination.= "<li><a onclick='changecomment({$id},2)'>2</a></li>";
	  $pagination.= "<li class='active'><a>...</a></li>";
	  for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++) {
		  if ($counter == $page) {
			  $pagination.= "<li class='active'><a>$counter</a></li>";
      } else {
			  $pagination.= "<li><a onclick='changecomment({$id},{$counter})'>$counter</a></li>";
      }
	  }
  }
}
if ($page==$number_of_page) {
  $pagination.= "<li class='active'><a href='#' rel='tooltip' title='Trang sau'>»</a></li>";
  $pagination.= "<li class='active'><a href='#'>Cuối</a></li>";
} else {
  $pagination.= "<li><a onclick='changecomment({$id},{$next})' rel='tooltip' title='Trang sau'>»</a></li>";
  $pagination.= "<li><a onclick='changecomment({$id},{$number_of_page})'>Cuối</a></li>";
}
$pagination.= "</ul>";
$pagination.= "</div>";
echo $pagination;
?>
