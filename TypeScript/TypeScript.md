# TypeScript

## 安装

```
npm i -g typescript
```

## 编译

```
tsc tscript.ts
```

### --outDir 制定编译输出文件夹

```
tsc --outDir ./dist tscript.ts
```

### --target 制定编译版本

```
tsc --outDir ./dist --target  es5 tscript.ts
```

### --watch 自动编译

```
tsc --watch tscript.ts
```

## VSCode配置ts自动编译

```
1. 项目目录生成tsconfig.json
tsc --init 

2. 修改tsconfig.json里outDir输出路径

3. 点击vscode终端 > 运行任务 > typeScript > 选择监视tsconfig.json
```

## TS中的数据类型

* 1.boolean

  ```
  let boo:boolean = true;
  ```

* 2.number

  ```
  let num:number = 2;
  ```

* 3.string

  ```
  let str:string = '123';
  ```

* 4.array

  ```
  let arr1:number[] = [1, 2, 3];
  let arr2:string[] = ['1', '2', '3']
  
  let arr3:Array<number> = [1, 2, 3]
  let arr4:Array<string> = ['1', '2', '3']
  let arr5:Array<any> = [1, '2', 4]
  ```

* 5.tuple 元组类型： 属于数组类型的一组

  ```
  let arr:[number, string] = [1, '2']
  ```

* 6.enum 每局类型

  ```
  enum Flag {success = 1, faild = 0}
  let suc:Flag = Flag.success //1
  
  enum Color {red, yellow=3, blue} // 不赋值默认为索引下标
  let c:Color = Color.red  // 0
  ```

* 7.any 任意类型

  ```
  let a:any = 1
  let b:any = 'str'
  let c:any = [1, '2']
  ```

* 8.null & undefined

  ```
  let n:number | undefined
  console.log(n)
  
  let u:number | undefined | null
  console.log(n)
  ```

* 9.void

  ```
  void function fn1() {
    console.log('无返回值')
  }
  
  function fn2():void {
    console.log('无返回值')
  }
  ```

* 10.never 其他类型（包含null 和 undefined）表示从来不会出现的值

## 函数

* 函数定义与返回值

  ```
  1. 函数声明
  function fn():number {
    return 123
  }
  2. 变量赋值
  let fn2 = function():number {
    return 456
  }
  ```

* 函数传参

  ```
  function fn(name:string, age:number):string {
    return `name:${name} --- age: ${age}`
  }
  fn('zs', 20);
  ```

* 可选参数

  ```
  function fn(name: string, age?: number): string {
    return `name:${name} --- age: ${age}`
  }
  fn('zs')
  ```

* 默认参数

  ```
  function fn(name: string, age: number = 12): string {
    return `name:${name} --- age: ${age}`
  }
  console.log(fn('zs'))
  ```

* 剩余参数

  ```
  function fn(...reset:Array<number>): number {
    return reset.reduce((before, after) => before + after)
  }
  ```

* 重载：参数不同实现不同的功能

  ```
  function fn(name:string):string;
  function fn(name:string, age: number):string;
  function fn(name:any, age?:any):any {
    if(age){
      return `name: ${name} -- age: ${age}`
    }else {
      return `name: ${name}`
    }
  }
  fn('zs', 12)
  ```

## Ts类

* 类的定义

  ```
  class Person {
    name:string;
    constructor(name:string){
      this.name = name
    }
  
    getName():string{
      return this.name
    }
  
    setName(name:string):void{
      this.name = name
    }
  }
  ```

* 类的继承

  ```
  class Chinese extends Person{
    constructor(name:string){
      super(name)
    }
  }
  
  let p1 = new Chinese('zs')
  ```

* 类修饰符

  * public: 公有属性     类内部，子类，类外部均可访问
  * protected: 保护类型  类内部，子类可访问
  * private: 私有属性    类内部可访问

* 类的静态属性

  ```
  class StaticClass {
    static prop = 'props'
    name:string;
    constructor(name:string){
      this.name = name
    }
  
    static run(){
      console.log(this.prop);
      //console.log(this.name); // 报错，静态方法不能直接调用构造函数属性
    }
  }
  StaticClass.prop
  ```

* 多态：父类定义一个方法不去实现，让继承它的子类去实现，每一个子类有不同的表现

  ```js
  class Animal{
    name:string;
    constructor(name:string){
      this.name = name
    }
    // 父类方法
    eat(){
      console.log('父类方法');
      
    }
  }
  
  class Dog extends Animal{
    constructor(name:string){
      super(name)
    }
    // 子类1方法
    eat(){
      console.log('Dog - 子类方法');
      
    }
  }
  
  class Cat extends Animal{
    constructor(name:string){
      super(name)
    }
    // 子类2方法
    eat(){
      console.log('Cat - 子类方法');
      
    }
  }
  ```

* abstract抽象类

  * 它是提供其他类继承的基类，不能直接使用
  * 用abstract关键字定义的抽象类和抽象方法，抽象类中的抽象方法不包含具体实现，必须在派生类中实现
  * 抽象类和抽象方法用来定义标准

  ```js
  abstract class Animal {
    name:string;
    constructor(name:string){
      this.name = name
    }
    abstract eat():void; // 抽象方法不能具有具体实现， 抽象方法只能出现在抽象类里
  }
  
  class Dog extends Animal{
    constructor(name:string){
      super(name)
    }
    eat(){
      console.log('Dog - eat方法'); // 子类必须有所继承抽象类中的抽象方法
      
    }
  }
  
  ```

## Ts接口

> 接口的作用：制定标准，起到限制规范的作用。ts中的接口类型包括属性，函数，可索引和类等

1. 属性接口：对json的约束

   ```js
   // 1.定义属性接口
   interface FullName{
     firstName:string; // 必须以分号结束
     secondName？:string; // 可选属性
   }
   
   // 2.使用属性接口
   function printName(name:FullName){
     // name参数对象必须包含接口中定义的属性
     console.log(name.firstName + name.secondName);
     
   }
   
   // 3.参数约束
   var nameObj = {
     firstName: 'zs',
     secondName: 'ls',
     age: 20 // 对象形式可包含多个参数, 但不建议。需严格按照接口定义参数
   }
   printName(nameObj);
   ```

2. 函数接口 ：对方法的参数和返回值进行约束

   ```
   // 1.定义函数接口
   interface encodeValue{
     (key:string, value:string):string;
   }
   
   // 2.使用函数接口
   var printValue:encodeValue = function(key:string, value:string):string{
     return key + value
   }
   
   // 3. 函数约束
   printValue('zs', 'ls')
   ```

3. 可索引接口：对数组，对象的约束（不常用）

   ```
   // 对数组的约束
   interface arrInter{
     [index:number]:string;
   }
   
   var arr:arrInter = ['zs', 'ls']
   
   // 对对象的约束
   interface ObjectInter{
     [index:string]:string;
   }
   
   var obj:ObjectInter = {
     key: 'key',
     value: 'value'
   }
   ```

4. 类类型接口 ：对类的约束 和 抽象类有点相似

   ```
   // 类接口定义
   interface Parent{
     name:string;
     action(str:string):void;
   }
   // 类接口使用
   class Child implements Parent{
     name:string;
     constructor(name:string){
       this.name = name
     }
   
     action(str:string):void{
       console.log(str);
       
     }
   }
   ```

5. 接口的扩展：接口可以继承接口

   ```
   interface Animal{
     eat():void;
   }
   
   interface Person extends Animal{
     work():void;
   }
   
   class Chinese implements Person{
     eat() {
       console.log('eat');
       
     }
   
     work() {
       console.log('work');
       
     }
   }
   ```

## Ts泛型

> 泛型就是解决类，接口，方法的复用性。以及对不特定数据类型的支持

1. 泛型函数

   ```
   function getData<T>(value:T):T{
     return value
   }
   
   getData<number>(123);
   getData<string>('str')
   ```

2. 泛型类

   ```
   class MinNum<T>{
     list:T[] = []
   
     add(num:T):void{
       this.list.push(num)
     }
   }
   
   var min = new MinNum<number>()
   min.add(1)
   ```

3. 泛型接口

   ```
   interface Config{
     <T>(value:T):T;
   }
   
   var fn:Config = function<T>(val:T):T {
     return val
   }
   
   fn<string>('zs')
   ```

   

