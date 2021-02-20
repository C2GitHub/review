# TypeScript

* 类型标注
* 类型检测

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

* 标记范围

  * 参数的类型
  * 返回值的类型 
  
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
  // 如果参数设置默认值，则自动变为可选参数
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

* 参数限制

  ```
  function test(direct: 'left'|'right'|'top'| 'bottom' = 'left'): string {
    return direct;
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

* 函数类型接口定义

  ```
  type CB = (a:number, b:number) => number;
  interface ICB {
    (a:number, b:number): number
  }
  ```

* 函数中this的标注

  ```
  interface IUser {
    name: string,
    age: number,
    eat(a:string): void
  }
  
  // this 的标注不会占用参数位置
  let user: IUser = {
    name: 'str',
    age:  35,
    eat(this:IUser, a){
      console.log(this)
    }
  }
  ```

  

## Ts面向对象

### 类的定义

* 构造函数不能有返回值，并且不能给构造函数标注类型
* Ts 中成员属性类型不能通过构造函数的初始化类定义，需提前定义

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

- 如果通过 public 标记构造函数属性，这不用提前定义属性，并会自动添加至成员属性

```
class CTest {
  constructor(
    public a: string,
    public b: number
  ) {
    
  }
}

// 编译后结果
var CTest = /** @class */ (function () {
    function CTest(a, b) {
        this.a = a;
        this.b = b;
    }
    return CTest;
}());
```

### 类的继承

```
class Chinese extends Person{
  constructor(name:string){
    super(name)
  }
}

let p1 = new Chinese('zs')
```

### 类修饰符

* public: 公有属性     类内部，子类，类外部均可访问
* protected: 保护类型  类内部，子类可访问
* private: 私有属性    类内部可访问
* readonly： 只读，只能初始化赋值一次

```
// 使用方式
class Person {
  constructor(public name: string) {}
}

// 所有修饰符最终编译结果一致
// 加修饰符会自动添加至成员属性，并且不需要预先定义类型
var Person = /** @class */ (function () {
    function Person(name) {
        this.name = name; // 成员属性
    }
    return Person;
}());
```

### getter  &  getter

```
// 使用 
class Person {
  constructor(public name: string) {}

  get _name() {
    return this.name;
  }

  set _name(name: string) {
    this.name = name;
  }
}

const user = new Person('zs');
user._name; // zs
user._name = 'ls';

// 编译结果（原理）
Object.defineProperty(Person.prototype, "_name", {
    get: function () {
        return this.name;
    },
    set: function (name) {
        this.name = name;
    },
    enumerable: false,
    configurable: true
});
```

### 类的静态属性

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

### 多态

>  父类定义一个方法不去实现，让继承它的子类去实现，每一个子类有不同的表现

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

### abstract抽象类

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

### 类与对象

* 对象描述方式

  ```
  interface PersonObject {
    name:string,
    getName: () => string
  }
  ```

* 类描述方式

  ```
  interface Person {
    new (name: string): PersonObject, // 构造函数
    age:number,  // 成员属性
    getName: () => string // 成员方法
  }
  ```

## Ts接口

> 1、标记对象、函数类型、数组、类
>
> 2、接口的作用：制定标准，起到限制规范的作用。ts中的接口类型包括属性，函数，可索引和类等

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

### 泛型函数

```
function getData<T>(value:T):T{
  return value;
}

getData<number>(123);
getData<string>('str')
```

### 泛型类

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

### 泛型接口

```
interface Config{
  <T>(value:T):T;
}

var fn:Config = function<T>(val:T):T {
  return val
}

fn<string>('zs')
```

### 泛型工具函数

* typeof  获取一个变量声明或对象的类型

* keyof  获取某种类型的所有键，其返回类型是联合类型

* in  遍历枚举类型

  ```
  type Keys = "a" | "b" | "c"
  
  type Obj =  {
    [p in Keys]: any
  } // { a: any, b: any, c: any }
  ```

* extends

  ```
  interface Lengthwise {
    length: number;
  }
  
  function loggingIdentity<T extends Lengthwise>(arg: T): T {
    console.log(arg.length);
    return arg;
  }
  ```

* Partial  `Partial<T>` 的作用就是将某个类型里的属性全部变为可选项 `?`。

* 

## 类型标记

* type
  * 可标记为任意类型
  * 无法实现类型合并
* interface 
  * 只能标记对象
  * 可扩展类型特性

* 

### type 与 interface 的区别

* interface只能表示function，object和class类型，type 表示所有类型

* interface可以合并同名接口，type不可以

  ```
  interface A{name:string}
  interface A{age:number}
  var x:A={name:'xx',age:20}
  ```

* 继承

  * interface 使用 extends 关键字继承 interface或type
  * type 使用 & 继承 type 或 interface，

  ```
  interface A{name:string}
  interface B extends A{age:number}
   
  type C={sex:string}
   
  interface D extends C{name:string}
   
  type E={name:string}&C
   
  type F ={age:number}&A
  ```

* 类可以实现interface，也可以实现type

  ```
  interface A{name:string;add:()=>void}
  type B={age:number,add:()=>void}
   
  class C implements A{
      name:'xx'
      add(){console.log('类实现接口')}
  }
   
  class D implements B{
      age:20
      add(){console.log('类实现type')}
  }
  ```

## TypeScript 断言

> 通过类型断言这种方式可以告诉编译器，当前类型的具体类型。

### 类型断言

* ##### “尖括号” 语法

  ```
  let someValue: any = "this is a string";
  let strLength: number = (<string>someValue).length;
  ```

* ##### as 语法

  ```
  let someValue: any = "this is a string";
  let strLength: number = (someValue as string).length;
  ```

### 非空断言

> 当类型检查器无法断定类型时，一个新的后缀表达式操作符 `!` 可以用于断言操作对象是非 null 和非 undefined 类型。**具体而言，x! 将从 x 值域中排除 null 和 undefined 。**

* ##### 忽略 undefined 和 null 类型

  ```
  function myFunc(maybeString: string | undefined | null) {
    const onlyString: string = maybeString; // Error
    const ignoreUndefinedAndNull: string = maybeString!; // Ok
  }
  ```

* ##### 调用函数时忽略 undefined 类型

  ```
  type NumGenerator = () => number;
  
  function myFunc(numGenerator: NumGenerator | undefined) {
    const num1 = numGenerator(); // Error
    const num2 = numGenerator!(); //OK
  }
  ```

  `!` 非空断言操作符会从编译生成的 JavaScript 代码中移除。

## 类型守卫

> 类型保护是可执行运行时检查的一种表达式，用于确保该类型在一定的范围内

#### in

#### typeof 关键字

#### instanceof 关键字

#### 自定义类型保护的类型谓词

```
function isNumber(x: any): x is number {
  return typeof x === "number";
}

function isString(x: any): x is string {
  return typeof x === "string";
}
```

## 联合类型和类型别名

#### 联合类型

* 联合类型通常与 `null` 或 `undefined` 一起使用 

  ```
  let name: string | undefined;
  let num: 1 | 2 = 1;
  type EventNames = 'click' | 'scroll' | 'mousemove';
  ```

#### 可辨识联合

* 可辨识：要求联合类型中的每个元素都含有一个单例类型属性

  ```
  enum CarTransmission {
    Automatic = 200,
    Manual = 300
  }
  
  interface Motorcycle {
    vType: "motorcycle"; // discriminant
    make: number; // year
  }
  
  interface Car {
    vType: "car"; // discriminant
    transmission: CarTransmission
  }
  
  interface Truck {
    vType: "truck"; // discriminant
    capacity: number; // in tons
  }
  ```

* 联合类型

  ```
  type Vehicle = Motorcycle | Car | Truck;
  ```

* 类型守卫

  ```
  function evaluatePrice(vehicle: Vehicle) {
    switch(vehicle.vType) {
      case "car":
        return vehicle.transmission * EVALUATION_FACTOR;
      case "truck":
        return vehicle.capacity * EVALUATION_FACTOR;
      case "motorcycle":
        return vehicle.make * EVALUATION_FACTOR;
    }
  }
  ```

#### 类型别名	

```
type Message = string | string[];

let greet = (message: Message) => {
  // ...
};
```

## 交叉类型

> 通过 `&` 运算符可以将现有的多种类型叠加到一起成为一种类型

```
type PartialPointX = { x: number; };
type Point = PartialPointX & { y: number; };

let point: Point = {
  x: 1,
  y: 1
}
```

* 同名基础类型属性的合并

* 同名非基础类型属性的合并

  ```
  interface D { d: boolean; }
  interface E { e: string; }
  interface F { f: number; }
  
  interface A { x: D; }
  interface B { x: E; }
  interface C { x: F; }
  
  type ABC = A & B & C;
  
  let abc: ABC = {
    x: {
      d: true,
      e: 'semlinker',
      f: 666
    }
  };
  
  console.log('abc:', abc);
  ```

### TypeScript 装饰器

#### 装饰器是什么

- 它是一个表达式
- 该表达式被执行后，返回一个函数
- 函数的入参分别为 target、name 和 descriptor
- 执行该函数后，可能返回 descriptor 对象，用于配置 target 对象

#### 13.2 装饰器的分类

- 类装饰器（Class decorators）
- 属性装饰器（Property decorators）
- 方法装饰器（Method decorators）
- 参数装饰器（Parameter decorators）

需要注意的是，若要启用实验性的装饰器特性，你必须在命令行或 `tsconfig.json` 里启用 `experimentalDecorators` 编译器选项：

**tsconfig.json**：

```
{
  "compilerOptions": {
     "target": "ES5",
     "experimentalDecorators": true
   }
}
```

#### 类装饰器

* 参数
  * target: TFunction - 被装饰的类

```
function Greeter(greeting: string) {
  return function (target: Function) {
    target.prototype.greet = function (): void {
      console.log(greeting);
    };
  };
}

@Greeter("Hello TS!")
class Greeting {
  constructor() {
    // 内部实现
  }
}

let myGreeting = new Greeting();
(myGreeting as any).greet();
```

#### 属性装饰器

* 参数
  * target: Object - 被装饰的类
  * propertyKey: string | symbol - 被装饰类的属性名

```
function logProperty(target: any, key: string) {
  delete target[key];

  const backingField = "_" + key;

  Object.defineProperty(target, backingField, {
    writable: true,
    enumerable: true,
    configurable: true
  });

  // property getter
  const getter = function (this: any) {
    const currVal = this[backingField];
    console.log(`Get: ${key} => ${currVal}`);
    return currVal;
  };

  // property setter
  const setter = function (this: any, newVal: any) {
    console.log(`Set: ${key} => ${newVal}`);
    this[backingField] = newVal;
  };

  // Create new property with getter and setter
  Object.defineProperty(target, key, {
    get: getter,
    set: setter,
    enumerable: true,
    configurable: true
  });
}

class Person { 
  @logProperty
  public name: string;

  constructor(name : string) { 
    this.name = name;
  }
}

const p1 = new Person("semlinker");
p1.name = "kakuqo";
```

#### 方法装饰器

* 参数
  * arget: Object - 被装饰的类
  * propertyKey: string | symbol - 方法名
  * descriptor: TypePropertyDescript - 属性描述符

```
function log(target: Object, propertyKey: string, descriptor: PropertyDescriptor) {
  let originalMethod = descriptor.value;
  descriptor.value = function (...args: any[]) {
    console.log("wrapped function: before invoking " + propertyKey);
    let result = originalMethod.apply(this, args);
    console.log("wrapped function: after invoking " + propertyKey);
    return result;
  };
}

class Task {
  @log
  runTask(arg: any): any {
    console.log("runTask invoked, args: " + arg);
    return "finished";
  }
}

let task = new Task();
let result = task.runTask("learn ts");
console.log("result: " + result);
```

#### 参数装饰器

* 参数
  * target: Object - 被装饰的类
  * propertyKey: string | symbol - 方法名
  * parameterIndex: number - 方法中参数的索引值

```
function Log(target: Function, key: string, parameterIndex: number) {
  let functionLogged = key || target.prototype.constructor.name;
  console.log(`The parameter in position ${parameterIndex} at ${functionLogged} has
 been decorated`);
}

class Greeter {
  greeting: string;
  constructor(@Log phrase: string) {
 this.greeting = phrase; 
  }
}
```

## tsconfig.json 

### 重要字段

* files - 设置要编译的文件的名称；
* include - 设置需要进行编译的文件，支持路径模式匹配；
* exclude - 设置无需进行编译的文件，支持路径模式匹配；
* compilerOptions - 设置与编译流程相关的选项。

### compilerOptions 选项

```
{
  "compilerOptions": {

    /* 基本选项 */
    "target": "es5",                       // 指定 ECMAScript 目标版本: 'ES3' (default), 'ES5', 'ES6'/'ES2015', 'ES2016', 'ES2017', or 'ESNEXT'
    "module": "commonjs",                  // 指定使用模块: 'commonjs', 'amd', 'system', 'umd' or 'es2015'
    "lib": [],                             // 指定要包含在编译中的库文件
    "allowJs": true,                       // 允许编译 javascript 文件
    "checkJs": true,                       // 报告 javascript 文件中的错误
    "jsx": "preserve",                     // 指定 jsx 代码的生成: 'preserve', 'react-native', or 'react'
    "declaration": true,                   // 生成相应的 '.d.ts' 文件
    "sourceMap": true,                     // 生成相应的 '.map' 文件
    "outFile": "./",                       // 将输出文件合并为一个文件
    "outDir": "./",                        // 指定输出目录
    "rootDir": "./",                       // 用来控制输出目录结构 --outDir.
    "removeComments": true,                // 删除编译后的所有的注释
    "noEmit": true,                        // 不生成输出文件
    "importHelpers": true,                 // 从 tslib 导入辅助工具函数
    "isolatedModules": true,               // 将每个文件做为单独的模块 （与 'ts.transpileModule' 类似）.

    /* 严格的类型检查选项 */
    "strict": true,                        // 启用所有严格类型检查选项
    "noImplicitAny": true,                 // 在表达式和声明上有隐含的 any类型时报错
    "strictNullChecks": true,              // 启用严格的 null 检查
    "noImplicitThis": true,                // 当 this 表达式值为 any 类型的时候，生成一个错误
    "alwaysStrict": true,                  // 以严格模式检查每个模块，并在每个文件里加入 'use strict'

    /* 额外的检查 */
    "noUnusedLocals": true,                // 有未使用的变量时，抛出错误
    "noUnusedParameters": true,            // 有未使用的参数时，抛出错误
    "noImplicitReturns": true,             // 并不是所有函数里的代码都有返回值时，抛出错误
    "noFallthroughCasesInSwitch": true,    // 报告 switch 语句的 fallthrough 错误。（即，不允许 switch 的 case 语句贯穿）

    /* 模块解析选项 */
    "moduleResolution": "node",            // 选择模块解析策略： 'node' (Node.js) or 'classic' (TypeScript pre-1.6)
    "baseUrl": "./",                       // 用于解析非相对模块名称的基目录
    "paths": {},                           // 模块名到基于 baseUrl 的路径映射的列表
    "rootDirs": [],                        // 根文件夹列表，其组合内容表示项目运行时的结构内容
    "typeRoots": [],                       // 包含类型声明的文件列表
    "types": [],                           // 需要包含的类型声明文件名列表
    "allowSyntheticDefaultImports": true,  // 允许从没有设置默认导出的模块中默认导入。

    /* Source Map Options */
    "sourceRoot": "./",                    // 指定调试器应该找到 TypeScript 文件而不是源文件的位置
    "mapRoot": "./",                       // 指定调试器应该找到映射文件而不是生成文件的位置
    "inlineSourceMap": true,               // 生成单个 soucemaps 文件，而不是将 sourcemaps 生成不同的文件
    "inlineSources": true,                 // 将代码与 sourcemaps 生成到一个文件中，要求同时设置了 --inlineSourceMap 或 --sourceMap 属性

    /* 其他选项 */
    "experimentalDecorators": true,        // 启用装饰器
    "emitDecoratorMetadata": true          // 为装饰器提供元数据的支持
  }
}
```

## 开发工具

* #### TypeScript Playground

  * 在线地址：https://www.typescriptlang.org/play/

* #### JSON TO TS

  * 在线地址：http://www.jsontots.com/

## 学习地址

https://mp.weixin.qq.com/s/aCJMArlnPsWOK4nGb5nBoQ

https://www.runoob.com/typescript/ts-tutorial.html