$(function()  {

  //グループファイル（objarr）を、番号順（昇順）にソートする。
  objarr.sort(function(a, b) {
    if (a.seq > b.seq) {
      return 1;
    } else {
      return -1;
    }
  });

  // 配列のリストを読んで、索引に書き込み 
  $.each(objarr, function(index, value) {

    //「索引」を書き出す。
    $('#indexList').append('<li><a href="#g' + value.grp + '">' + value.nm + '</li>');      
  
    // 本文に「見出し」を書き出す。
    $('#mains').append('<h3 id="g' + value.grp + '">'+ value.nm + '</h3>');

    // 定義付けリストの開始行を書き出す。 
    var str = '<dl id="op' + value.grp + ' class="inner">';        

    var grp1 = value.grp;
    selarr2 = [];
    // grpが一致する行だけを抽出して、配列に追加する。
    $.each(objarr2, function(index, value) {
      if (value.grp == grp1)
      selarr2.push(value);    
    });  

    // グループファイル（selarr2）を、番号順（昇順）にソートする。
    selarr2.sort(function(a, b) {
      if (a.seqingrp > b.seqingrp) {
        return 1;
      } else {
        return -1;
      }
    });

    // リンク先を示す行を、本文に追加する。
    $.each(selarr2, function(index, value) {
      str += '<dt><input class="lineguide" type="button" value="説明"><a href="' + value.url + '" target="_blank">' + value.dt + '</a></dt>';    
      str += '<dd>' + value.dd + '</dd>';    
    });  
      
    // 定義付けリストの終了行を書き出す。 
    str += '</dl>';

    $('#mains').append(str); 

  });      

  /* 各グループをアコーディオン表示  */
    //.リストの中のh3要素がクリックされたら
    $('h3').click(function(){

      //クリックされたh3要素に隣接するdl要素が開いたり閉じたりする。
      $(this).next('dl').slideToggle();

    });

    //.closeがクリックされたら
    $('.close').click(function () {

      //クリックされた.closeの親要素の.accordionの.innerを閉じる。
      $(this).parents('.accordion .inner').slideUp();

    });

  /* 各行の説明をアコーディオン表示  */
    // 各行のボタンがクリックされたら  
    $("input").click(function(e)  { 

      var obj = event.target;
      var dt = obj.parentNode;
      var dd = dt.nextElementSibling;
   
      // クリックしたボタンの行の背景色を変更し、  
      // クリックしたボタンの行の説明を表示する  */
      if (dd.style.display == "block") {
        dt.style.backgroundColor = "yellow";
        dd.style.display = "none";
      } else {
        dt.style.backgroundColor = "white";
        dd.style.display = "block";
      };

    });

})