# 提交规范

## type 说明

```
# 主要type
feat:     增加新功能
fix:      修复bug

# 特殊type
docs:     只改动了文档相关的内容
style:    不影响代码含义的改动，例如去掉空格、改变缩进、增删分号
build:    构造工具的或者外部依赖的改动，例如webpack，npm
refactor: 代码重构时使用
revert:   执行git revert打印的message

# 暂不使用type
test:     添加测试或者修改现有测试
perf:     提高性能的改动
ci:       与CI（持续集成服务）有关的改动
chore:    不修改src或者test的其余修改，例如构建过程或辅助工具的变动
```



------

## 安装

https://git-scm.com/

## 配置

当安装完 Git 应该做的第一件事就是设置你的用户名称与邮件地址。 这样做很重要，因为每一个 Git 的提交都会使用这些信息，并且它会写入到你的每一次提交中，不可更改

```bash
git config user.name "你的姓名"
git config user.email "你的邮箱"
```

### -- global

通过 `--global` 选项可以设置全局配置信息

```bash
git config --global user.name "你的姓名"
git config --global user.email "你的邮箱"
```

### 检查配置

```bash
# 打印所有config
git config --list
# 打印指定config
git config user.name
```

### 乱码

#### git status 显示乱码

```bash
git config --global core.quotepath false
```

### 修改默认编辑器

```bash
git config core.editor notepad

# 添加 vscode 编辑器 - mac
# 通过 vim 打开环境变量配置文件
vim ~/.bash_profile
# 添加环境变量
export PATH=/Applications/Visual\ Studio\ Code.app/Contents/Resources/app/bin:$PATH
# 保存退出
source ~/.bash_profile
# 测试：在终端中直接通过命令 code 调用 vscode
git config --global core.editor "code --wait"
```

# Git命令

### 添加操作 git add

```
git add <filename>                     //添加到暂存区（stage)
git add .                              //全部提交到暂存区
```

### 提交操作 git commit 

```
git commit -m <description>           //提交到本地库(必须先add)
git commit -am                        //可提交未add文件，但是不包括未创建文件

// 修复式提交, 和上一次提交合并，不会产生新的commit节点
git commit --amend -m "descr iption"   //这个命令会将暂存区中的文件提交。 如果自上次提交以来你还未做任何修改(例如，在上次提交后马上执行了此命令)，那么快照会保持不变，而你所修改的只是提交信息。
```

### 删除操作 git rm

> 每次进行删除操作后，需重新执行git add / git commit

```
git rm <file>             //从暂存区删除（stage)  
git rm -f <file>          //删除之前修改过并且已经放到暂存区域
git rm --cached <file>    //如果把文件从暂存区域移除，但仍然希望保留在当前工作目录中，换句话说，仅是从跟踪清单中删除
```

### 撤销操作

在Git中，用HEAD表示当 前版本。

```
git HEAD
git HEAD~        //上一个版本
git HEAD~100     //往上100个版本
```

#### 撤销add

```
git checkout <file>          //恢复未提交的更改

git reset HEAD <file>        //取消之前 git add 添加
git reset HEAD .             //取消所有 git add 添加
```

#### 撤销commit

![图片描述](https://segmentfault.com/img/bVbd5Km)

##### git reset

```
git reset --hard HEAD~              //回退到上一个版本
git reset --hard <commit ID>        //回退到指定版本
```

版本直接回退，简单粗暴。
**如果远程分支也想要回退，git push -f (known changes)。**

##### git revert

```
git revert HEAD //撤销前一次commit
```

**不能随便删除已经发布的提交，这时需要通过revert创建要否定的提交。**
![图片描述](https://segmentfault.com/img/bVbd2gX)

如果不小心提交了不想要的代码，而小伙伴在你发现时，已经提交了，这时候就不能简单的回退版本。

```
git revert <commit ID> //需要撤销的提交ID
```

这时候会有冲突，解决冲突之后，再重新提交，那么就会产生一条新的提交纪录。
**提交到远程分支，git push。**

> git revert 和 git reset的区别

1. git revert是用一次新的commit来回滚之前的commit，git reset是直接删除指定的commit。
2. 在回滚这一操作上看，效果差不多。但是在日后继续merge以前的老版本时有区别。因为git revert是用一次逆向的commit“中和”之前的提交，因此日后合并老的branch时，导致这部分改变不会再次出现，但是git reset是之间把某些commit在某个branch上删除，因而和老的branch再次merge时，这些被回滚的commit应该还会被引入。
3. git reset 是把HEAD向后移动了一下，而git revert是HEAD继续前进，只是新的commit的内容和要revert的内容正好相反，能够抵消要被revert的内容。

### 移动或重命名操作

git mv 命令用于移动或重命名一个文件、目录。

```
git mv <file> 
git mv <old name>  <new name>
```

其实，运行 git mv 就相当于运行了下面三条命令：

```
mv README.md README
git rm README.md
git add README
```

### git rebase

**git rebase和git merge区别**
![图片描述](https://segmentfault.com/img/bVU4U9)
![图片描述](https://segmentfault.com/img/bVU4VE)
在rebase的过程中，也许会出现冲突(conflict)。 在这种情况，Git会停止rebase并会让你去解决冲突；在解决完冲突后，用"git-add"命令去更新这些内容的索引(index)， 然后，你无需执行 git-commit，只要执行:

```
git rebase --continue      //继续
git rebase --abort         //取消
```

#### git rebase -i

在rebase指定i选项，您可以改写、替换、删除或合并提交。

```
git rebase -i [startpoint] [endpoint]
```

其中-i的意思是--interactive，即弹出交互式的界面让用户编辑完成合并操作，[startpoint] [endpoint]则指定了一个编辑区间，如果不指定[endpoint]，则该区间的终点默认是当前分支HEAD所指向的commit(注：该区间指定的是一个前开后闭的区间)。

- pick：保留该commit（缩写:p）
- reword：保留该commit，但我需要修改该commit的注释（缩写:r）
- edit：保留该commit, 但我要停下来修改该提交(不仅仅修改注释)（缩写:e）
- squash：将该commit和前一个commit合并（缩写:s）
- fixup：将该commit和前一个commit合并，但我不要保留该提交的注释信息（缩写:f）
- exec：执行shell命令（缩写:x）
- drop：我要丢弃该commit（缩写:d）

**合并历史纪录**

```
git rebase -i HEAD~2

//我们会进入vit模式，将pick改成squash，然后按esc : wq（保存并退出）。

git push -f
```

![图片描述](https://segmentfault.com/img/bVbd2oV)
![图片描述](https://segmentfault.com/img/bVbd5Kq)

### git status

要查看哪些文件处于什么状态。

```
git status -s | git status --short //得到一种更为紧凑的格式输出
```

### git diff 

git diff 命令显示add与commit的改动区别。

```
git diff  <file>            //尚未缓存的改动
git diff --cached           //查看已缓存的改动
git diff HEAD               //查看已缓存的与未缓存的所有改动
git diff --stat             //显示摘要而非整个 diff
```

### 查看提交历史

#### git log

在提交了若干更新，又或者克隆了某个项目之后，你也许想回顾下提交历史。 完成这个任务最简单而又有效的工具是 git log 命令。

```
git log -p          //用来显示每次提交的内容差异
git log -2          //仅显示最近两次提交
git log --stat      //每次提交的简略的统计信息
git log --pretty    //指定使用不同于默认格式的方式展示提交历史，git log --pretty=oneline
```

> 使用git show命令查看某一次提交详细信息。

#### git reflog

> 如果在回退以后又想再次回到之前的版本，git reflog 可以查看所有分支的所有操作记录（包括commit和reset的操作），包括已经被删除的commit记录，git log则不能察看已经删除了的commit记录。

```
git reflog
```

### git stash

在Git中，隐藏操作将使您能够修改跟踪文件，阶段更改，并将其保存在一系列未完成的更改中，并可以随时重新应用。

```
git stash          //把当前工作的改变隐藏起来
git stash list     //查看已存在更改的列表
git stash pop      //可从堆栈中删除更改并将其放置在当前工作目录中
```

### 分支操作

#### 创建分支

```
git branch <branch name>               //创建分支
git checkout <branch name>             //切换到分支

git checkout -b <branch name>          //创建并切换到分支
```

#### 删除分支

```
git branch -d <branch name>
git branch -D <branch name>       //强制删除分支
```

#### 删除多个分支

必须在git bash命令下输入

```
git branch | grep '分支名' //匹配分支名，可用正则
git branch | grep '分支名' | cut-c 2- | xargs git branch -D
反选：git branch | grep '分支名' -D
```

#### 查看分支

```
git branch <name>
git branch -a      //查看所有分支
git branch -r      //查看远程分支
```

#### 重命名分支

```
git branch -m <old name> <new name>
```

#### 合并分支

```
git checkout master                    //切换到master
git merge <branch name>                //合并分支
```

**如果分支未pull最新代码，那么提交的时候，历史纪录就不清晰;汇合分支上的提交，然后一同合并到分支**
![图片描述](https://segmentfault.com/img/bVbd2gp)

```
git merge –squash <branch name>
git commit -am
git push
```

#### 提取其他分支提交

在cherry-pick，您可以从其他分支复制指定的提交，然后导入到现在的分支。

```
git cherry-pick <commit id>
```

### 标签操作

如果你达到一个重要的阶段，并希望永远记住那个特别的提交快照，你可以使用 git tag 给它打上标签。

#### 创建标签

```
git tag <name>
git tag -a <name>              //创建一个带注解的标签
```

#### 查看标签

```
git tag
git show <tag name>
git push origin <tag name>
```

#### 删除标签

```
git tag -d <name>
```

------



# 异常处理

## 提交到缓存区之前

只是修改了本地代码，还未执行`git add` 添加到缓存区

#### （一）本地工作区文件恢复

当想撤销某个文件的修改，或者某个文件被无意中删除了且清空了回收站，此时想要找回文件

**语法**：`git checkout <filename/dirname>`

**命令**：`git checkout 1.js`

撤回回工作区1.js文件的修改

**命令**：`git checkout .`

撤回工作区所有文件的修改

## 提交到缓存区之后，还未提交到本地仓库

已经执行`git add`，还未执行`git commit`提交到本地仓库

#### （二）撤销缓存区操作

各位大佬都是拥有极快手速的人，很容易一个`git add .`把代码全部提交到缓存区了，但是突然想起少加了个注释，身为拥有强迫症的大家，这时候肯定不会选择继续`commit`，而且撤回修改后重新`add`

**语法**：`git restore --staged <filename/dirname>` / `git reset HEAD <filename/dirname>`

**命令**：`git restore --staged 1.js` / `git reset HEAD 1.js`

撤回回缓存区1.js文件的修改，但不会撤销文件的更改

**命令**：`git restore --staged .` / `git reset HEAD .`

撤回工作区所有文件的修改

**简单理解就是该功能只能撤销`add`操作**

## 提交到本地仓库，还未提交到远程仓库

已经执行`git commit`，还未执行`git push`提交到远程仓库

#### （三）修改本地仓库提交信息

已经执行了add和commit操作，此时想修改commit提交信息，有两种方式

**语法**：`git commit --amend`

**命令**：`git commit --amend -m "新的提交信息"`

此命令可以直接把上个commit信息替换为新的提交信息

**命令**：`git commit --amend`

此命令会用vim打开上次的commit文件，在里面用vim命令修改

**简单理解就是该功能只能修改`commit`操作的备注信息**

> 还有种情况就是commit了，但是发现有个文件还没保存该怎么处理，此时可以保存后执行`git add`提交刚漏掉的文件，然后执行`git commit --amend --no-edit`即可把这次提交合并到上一次中。

#### （四）撤回本地仓库的提交

已经执行了add和commit操作，此时想撤回commit提交

**语法**：`git reset --soft [<commit-id>/HEAD~n>]`

**命令**：`git reset --soft HEAD~1`

撤回最近一次的commit，文件变更记录与未提交之前的文件变更记录是一致的，只是撤销了 commit 的操作。

**简单理解就是该功能只是撤销了`commit`操作**

#### （五）撤回本地仓库和缓存区的提交

已经执行了add和commit操作，此时回到add前的状态，修改后再重新提交

**语法**：`git reset --mixed [<commit-id>/HEAD~n>]`

**命令**：`git reset --mixed HEAD~1`

撤回最近一次的commit和add，已经变更的记录在缓存区也没有了。

**简单理解就是该功能撤销了`add`和`commit`操作**，**回到了刚修改完文件的状态**

#### （六）撤回提交的错误文件（强烈建议别用）

已经执行了add和commit操作，此时发现有个文件是不需要的，需要撤回

**语法**：`git reset --hard [<commit-id>/HEAD~n>]`

**命令**：`git reset --hard HEAD~1`

撤回最近一次的commit和add，已追踪文件的变更内容都消失了，比如有一个test1文件，修改了其中内容，新增了一个test2文件，此时把两个文件都提交了，如果执行了该命令，结果就是test1的修改记录没有了，新增的test2文件也消失了。

**简单理解就是该功能撤销了`add`和`commit`操作**，**同时丢弃了这次修改内容**，**请谨慎使用**

## 分支相关

#### （七）修改分支名，实现无缝衔接

我们想要新建的分支名为 branch1，却由于训练多年的麒麟臂，写成了 branch2

**语法**：`git branch -m <oldbranch> <newbranch>`

**命令**：`git branch -m branch2 branch1`

把写错的branch2分支名修改为branch1

#### （八）本地分支关联远程仓库分支

我想使用`git pull origin branchName`和`git push origin branchName`时，直接使用`git pull`和`git push`，那么就需要和远程仓库关联

**语法**：`git branch --set-upstream-to=<remoteName/branchName`

**命令**：`git branch --set-upstream-to=origin/branch1`

通过 `git branch -vv` 查看分支的关联关系，可以看到本地分支和远程仓库origin的branch1分支已经关联

#### （九）远程分支删除后，删除本地分支及关联

为方便分支提交，一般情况下会用本地命令 `git branch --set-upstream-to=origin/master master` 建立本地分支与远程分支的关联，从 master 拉出的分支可以自动建立与远程已有分支的关联，这样可以很方便的使用 `git pull` 和 `git push` 拉取远程分支的代码和将本地分支提交到远程。

但是 远程分支删除之后，本地分支就无法成功推送到远程，想要重新建立与远程仓库的关联，就需要先删除其原本的与已删除的远程分支的关联。

假设删除的远程分支为 branch1，使用 `git push origin --delete branch1` 删除掉对应的远程分支之后，再删除本地分支关联。

**语法**：`git branch --unset-upstream <branchName>`

**命令**：`git branch --unset-upstream branch1`

删除掉关联关系之后，用 `git branch -vv` 命令可查看到本地分支与远程分支已经没有关联了

#### （十）恢复误删除的本地分支

本地分支拉取之后，由于疏忽被删除，而且本地的分支并没有被同步到远程分支上，此时想要恢复本地分支。误删的分支为 test，使用 `git reflog`可查看到该仓库下的所有历史操作，如下所示（#为备注）：

```bash
# 从test切换到master
d1dda63 (HEAD -> master, origin/master) HEAD@{0}: checkout: moving from test to master
# 提交了 测试000
9b3003d HEAD@{1}: commit: 测试000
# 从master切换到test
d1dda63 (HEAD -> master, origin/master) HEAD@{2}: checkout: moving from master to test
# 合并了test代码
d1dda63 (HEAD -> master, origin/master) HEAD@{3}: merge test: Fast-forward
# 从test切换到master
48a61f7 HEAD@{4}: checkout: moving from test to master
12345678910
```

**语法**：`git checkout -b <branch-name> <commit-id>`

**命令**：`git checkout -b test HEAD@{1}`

该命令会创建一个`test`分支并切换到该分支，然后命令执行完成后，这里可以看到最近一次test分支快照是 HEAD@{2} （*# 从master切换到test*），这里我们执行命令后即从 master 分支拉取 `test`分支的内容，但是仍然缺少没有同步远程仓库，而存在本地仓库的新提交HEAD@{1}（*# 提交了 测试000*），想要将文件内容恢复到最新的提交内容，使用命令 `git reset --hard HEAD@{1}` 即可实现硬性覆盖本地工作区内容的目的。`git reflog` 命令获取到的内容为本地仓库所有发生过的变更，非常好用。