<?php
  function transformType($t) {
    switch ($t) {
       case 'a' :
          return 'a - 动画';
          break;
       case 'b' :
          return 'b - 漫画';
          break;
       case 'c' :
          return 'c - 游戏';
          break;
       case 'd' :
          return 'd - 文学';
          break;
       case 'e' :
          return 'e - 原创';
          break;
       case 'f' :
          return 'f - 来自网络';
       case 'f' :
          return 'f - 来自网络';
          break;
       case 'g' : 
          return 'g - 其他';
          break;
       case 'h' : 
          return 'h - 影视';
          break;
       case 'i' :
          return 'i - 诗词';
          break;
       case 'j' :
          return 'j - 网易云';
          break;
       case 'k' :
          return 'k - 哲学';
          break;
       case 'l' :
          return 'l -抖机灵';
          break;
       default:
          return $t.' - 未知分类';
          break;
    }
  }

