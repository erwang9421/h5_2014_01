<?php

function getData(){
	if(!isset($_SESSION['username'])||$_SESSION['username']=='')
	{
		return "我不相信我没登录";
	}
	else{
		$username = $_SESSION['username'];
    	$userModel = M('users');
    	$authorModel = M('author');
    	$fansModel = M('fans');
  		$bookreviewModel = M('bookreview');
    	$condition->username = $username;
   	 	$a = $userModel->where($condition)->select();
    	$b = $authorModel->where($condition)->select();
    	$list =array_merge($a,$b);
    	//粉丝数量 粉丝表中的username和这个用户的usename相同的数量
  		$condition->username = $list['username'];
    	$list[0]['fan'] = $fansModel->where($condition)->count();
    	//关注数量
    	$condition2->fanname = $list['username'];
    	$list[0]['attention'] = $fansModel->where($condition2)->count();
		//文章数量
		$condition3->username = $list['username'];
		$list[0]['bookreviews'] = $bookreviewModel->where($condition3)->count();
		//收藏数量
		$condition4->fanname = $list['username'];
    	return $list;
	}
}


function getmsg(){
  		$bookreviewModel = M('bookreview');
		$list3 = $bookreviewModel->join('books  ON bookreview.bookid = books.bookid')->join( 'author ON bookreview.username = author.username' )->select();
		$list4 = $bookreviewModel->join('books  ON bookreview.bookid = books.bookid')->join( 'users ON bookreview.username = users.username' )->select();
		$list5 =array_merge($list4,$list3);
		return $list5;
}

// function layout(){
//     $bookcategoryModel=M("bookscategories");
//     $bookscategories=$bookcategoryModel->select();
//     $this->assign("bookcategory",$bookscategories);

// }

/*function getTags(){
	

    return $first;
}*/