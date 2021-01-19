# vue-study
vue学习总结

## 源码解析

### 要点

* vue工作机制
* vue响应式原理
* 依赖收集与追踪
* 编译compile

### Vue工作机制

![vue底层原理关系图](.\vue底层原理关系图.png)

### 初始化

在new Vue()之后，Vue会调用进行初始化。会初始化生命周期 ，事件，props，methods，data，computed与watch等。其中最重要的是通过Object.defineProperty设置setter与getter，用来实现**【响应式】**以及**【依赖收集】**。

初始化之后会调用`$mount`挂载组件。



### 编译

编译模板分为三个阶段：

1. parse
   * 使用正则解析template中的vue指令（v-xxx）变量等等，形成语法树AST
2. optimize
   * 标记一些静态节点，用作后面的性能优化，在diff的时候直接略过
3. generate
   * 把第一部分生成的AST转化为渲染函数render function

编译过程：

通过Vue写的模板内容浏览器根本就不识别，通过编译的过程可以进行依赖收集，进行依赖收集以后就可以把data中的数据和视图之间产生依赖关系，如果以后模型发生变化的时候，我们就可以通知这额依赖的地方让他们进行更新。做到模型驱动视图的变化。

### 响应式原理

初始化的时候通过defineProperty进行绑定，设置通知的机制，当编译生成的渲染函数实际渲染的时候，会出发getter进行依赖收集，在数据变化的收，会触发setter进行更新。

* 数据劫持

  vue利用数据绑定的原理，通过Object.defineProperty属性，把data中的数据每一个属性都定义了一个getter和setter，这有让我们有机会去监听这些属性的变化，当这些属性变化的时候，我们可以通知那些需要更新的地方去做更新。

#### defineProperty

```html
  <div id="app">
    <input type="text" id="name">
  </div>

  <script>
    const obj = {};
    Object.defineProperty(obj, 'name', {
      get: function() {
        return document.querySelector('#name').value;
      },
      set: function(val) {
        document.querySelector('#name').value = val;
      }
    })

    obj.name = 'helloWorld!';
    console.log(obj.name);

  </script>
```

#### 实现数据响应

### $nextTick原理

* MutationObserver

* MO是HTML5中的API，是一个用于监视DOM变动的接口，它可以监听一个DOM对象上发生的子节点删除、属性修改、文本内容修改等。

```
// Firefox和Chrome早期版本中带有前缀
var MutationObserver = window.MutationObserver || window.WebKitMutationObserver || window.MozMutationObserver
// 选择目标节点
var target = document.querySelector('#some-id'); 
// 创建观察者对象
var observer = new MutationObserver(function(mutations) {  
  mutations.forEach(function(mutation) { 
    console.log(mutation.type); 
  }); 
}); 
// 配置观察选项:
var config = { attributes: true, childList: true, characterData: true } 
// 传入目标节点和观察选项
observer.observe(target, config); 
// 随后,你还可以停止观察
observer.disconnect();
```





### 虚拟dom

Virtual DOM就是用JavaScript对象来描述dom结构，数据修改的时候，我们先修改虚拟dom中的 数据，然后数组做diff，最后汇总所有的diff，力求做最少的dom操作，毕竟js里对比很快，而真实dom操作太慢



### 双向数据绑定原理

通过在input类的输入元素上使用v-model指令，在编译的时候可以解析出v-model，在对其做操作的时候v-model会做两件事情：

1. 在解析出当前v-model的元素上添加一个input事件监听，当value值发生改变的时候，可以将最新的值更新到vue实例上。
2. 因为vue实例已经实现了数据的响应化，响应化的setter函数会触发页面中所有模型的依赖做更新，所以页面中跟这个数据相关的部分就更新了。

### render函数

![img](https://upload-images.jianshu.io/upload_images/13429147-32832d6b08b108c4.jpg?imageMogr2/auto-orient/strip|imageView2/2/w/1200/format/webp)render为渲染函数，它的参数也是一个函数-既createElement

* render 函数的返回值

  * VNode（既虚拟节点）

* render函数的参数

  * createElement本身也是一个函数，并且有三个参数

  1. 一个HTML标签字符串，组件对象
  2. 用在template中的数据对象
  3. 子虚拟节点

## 项目实现

### 登陆信息验证

* 设置全局守卫

* 利用token判别是否登陆过

  ```
  router.beforeEach((to, from, next) => {
    // 验证是否登陆过
    if (to.meta.auth) {
      if (localStorage.getItem('token')) {
        next();
      } else {
        next({
          path: '/login',
          query: {
            direct: to.fullPath,
          },
        });
      }
    } else {
      next();
    }
  });
  ```

## 保存登陆状态

* 将状态保存在vuex

  ```
  import Vue from 'vue';
  import Vuex from 'vuex';
  import us from '../server/user';
  
  Vue.use(Vuex);
  
  export default new Vuex.Store({
    state: {
      isLogin: false,
    },
    mutations: {
      setLogin(state, isLogin) {
        state.isLogin = isLogin;
      },
    },
    actions: {
      login({ commit }, user) {
      // us.login 返回个promise方法
        return us.login(user)
          .then((res) => {
            const { code, token } = res.data;
            if (code) {
              // 用户登陆成功
              commit('setLogin', true);
              localStorage.setItem('token', token);
            }
            return code;
          });
      },
    },
    modules: {
    },
  });
  
  ```

* 设置路由守卫
* 进行一步操作
* 保存登陆状态
* 模拟接口



## HTTP拦截器

* 创建interceptor.js

  ```
  // 用于拦截请求和相应
  import axios from 'axios';
  
  export default function (vm) {
    // 设置请求拦截器
    axios.interceptors.request.use((config) => {
      // 获取token
      const token = localStorage.getItem('token');
  
      // 如果存在令牌，则添加到token请求头
      if (token) {
        config.headers.token = token;
      }
      return config;
    });
  
    // 设置响应拦截器
    // 第一个参数代表成功状态
    // 第二个参数代表失败状态
    axios.interceptors.response.use(null, (err) => {
      if (err.response.status === 401) { // 没有登录或令牌过期
        // 清空缓存
        vm.$store.dispatch('logout');
        // 跳转到login
        vm.$router.push('/login');
      }
      return Promise.reject(err);
    });
  }
  
  ```

* 在mian.js导入拦截器并初始化

  ```
  import interceptor from './interceptor';
  
  // 执行拦截器初始化
  interceptor(vm);
  ```

  

## mock数据 vue.config.js

* 模拟后台接口

  ```
  evServer: {
    before(app) {
      // 模拟后台服务器 express
      app.get('/api/login', (req, res) => {
        const { username, password } = req.query;
        console.log(username, password);
  
        if (username === 'zs' && password === '123') {
          res.json({ code: 1, token: 'tokenABC' });
        } else {
          res.status(401).json({ code: 0, message: '用户名或密码错误' });
        }
      });
    },
  }
  ```

  

* 后台接口保护

  ```
  // 定义认证中间件
  function auth(req, res, next) {
    if (req.headers.token) {
      // 已认证
      next();
    } else {
      // 用户未授权
      res.sendStatus(401);
    }
  }
  
  // 对后台接口进行保护/api/userinfo
  app.get('/api/userinfo', auth, (req, res) => {
    res.json({ code: 1, data: { name: 'zs', age: 20 } });
  });
  ```

## 注销

* 需要清除token缓存的两种情况
  * 用户主动注销
  * token过期

* 需要做的事情
  * 清除缓存
  * 重置登陆状态



## demo

*  自定义Input组件，实现双向绑定

```JavaScript
// v-modle原理

// 父组件
<template>
  <div id="app">\
      // 1. 方式1：绑定value值， 监听input事件
    <Input :value="value" @input="value = arguments[0]" />
     // 2.方式2:和方式1效果一致
    <Input v-model="value" />
  </div>
</template>

// 子组件
<template>
  <div>
    <input type="text" :value="value" @input="onInput" />

    {{value}}
  </div>
</template>

<script>
export default {
  props: ['value'],
  methods: {
    onInput(e) {
      this.$emit('input', e.target.value);
    },
  },
};
</script>

<style lang="scss" scoped>
</style>
```

