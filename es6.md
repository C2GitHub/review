# ES6

1. let，const

   * 块级作用域
   * 不存在变量申明提升
   * 不允许重复申明
   * 暂时性死区

2. 解构赋值

   * 数组的解构赋值
   * 对象的解构赋值
   * 字符串的解构赋值

3. 字符串的扩展

   * 加强对Unicode的支持
   * codePointAt
   * fromCodePoint
   * at
   * startWith
   * endWith
   * padStart
   * padEnd
   * includes
   * repeat
   * 模板字符串

4. 数值的扩展

   * 二进制和八进制表示：0b, 0o
   * isFinite
   * isNaN
   * isInteger
   * Math扩展
     * Math.trunc: 返回小数的整数部分
     * Math.sign：判断正负数
     * Math.cbrt： 开立方

5. 正则的扩展

   * u修饰符：Unicode模式
   * y修饰符：粘连模式
   * s修饰符：任意单个字符

6. 函数的扩展

   * 箭头函数
   * 默认参数、rest参数
   * this指向

7. 数组的扩展

   * 扩展运算符
   * Array.form: 伪数组转数组
   * Array.of: 将一组数字转数组
   * find
   * findIndex
   * keys
   * values
   * entries
   * includes

8. 对象的扩展

   * 简洁表示法
   * 扩展运算符
   * Object.assign：浅拷贝
   * Object.keys
   * Object.values
   * Object.entries

9. symbol

   * 表示独一无二的数

10. Set

    * 用法类似于数组

    * 所有成员都是唯一的

      ```
      // 数组去重
      let arr = [...new Set(arr)];
      let arr2 = Array.from(new Set(arr));
      ```

11. Map

    * 键值对的集合
    * 键可以是任意类型

12. Proxy

    ```
    var obj = new Proxy({}, {
      get: function (target, key, receiver) {
        console.log(`getting ${key}!`);
        return Reflect.get(target, key, receiver);
      },
      set: function (target, key, value, receiver) {
        console.log(`setting ${key}!`);
        return Reflect.set(target, key, value, receiver);
      }
    });
    ```

13. Reflect

14. Promise

15. Iterator和for...of循环

16. Generator

17. async和await

18. class

19. es6模块化