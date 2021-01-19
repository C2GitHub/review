# flex布局



* 遗忘点
  * flex-flow:  flex-direction  flex-wrap; 
  * flex : flex-grow  flex-shrink  flex-basis;
    * 放大比率   默认0（不放大）
    * 缩小比率  默认 1（等比缩小）
    * 基础尺寸  默认 auto



## display：flex

* 父盒子定义
* 默认子元素会水平排列（包括块级元素）

## flex-direction(主轴方向)

* row 水平排列（默认）
* row-reverse 水平反转
* column: 垂直布局 （最常用）
* column-reverse: 垂直反转

## 对齐方式

### justify-content(主轴)

* center
* space-between

```
flex-start | flex-end | center | space-between | space-around | initial | inherit
```

### align-items(交叉轴)

* center

```
align-items: stretch|center|flex-start|flex-end|baseline|initial|inherit;
```

### flex-wrap

* nowrap（默认）
* wrap （常用)

```
flex-wrap: nowrap|wrap|wrap-reverse|initial|inherit;
```