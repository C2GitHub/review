# TypeScript

## 安装

```
npm i -g typescript
```

## 编译

```
tsc tscript.ts
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

* 1

* 

  