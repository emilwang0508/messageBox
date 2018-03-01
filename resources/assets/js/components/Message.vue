<template>
    <div class="message-pannel">
        <div class="message-header">
            <div class="float-right">
                <el-dropdown @command="handleCommand">
                    <span class="el-dropdown-link">
                    {{dropdownName}}<i class="el-icon-arrow-down el-icon--right"></i>
                    </span>
                    <el-dropdown-menu slot="dropdown">
                        <el-dropdown-item command="3">按时间由近及远</el-dropdown-item>
                        <el-dropdown-item command="4">按时间由远及近</el-dropdown-item>
                        <el-dropdown-item command="1">按点赞次数由多到少</el-dropdown-item>
                        <el-dropdown-item command="2">按点赞次数由少到多</el-dropdown-item>
                    </el-dropdown-menu>
                </el-dropdown>
            </div>
            <br>
        </div>

        <div class="message-body" v-for="(item, index) in items" v-show="pageShow(index)">
            <el-card class="box-card message clearfix" >
                <p><span class="created_at">{{item.created_at}}</span><span class="username" v-if="item.type===2">匿名公开</span><span class="username" v-else>匿名不公开（仅管理员可见）</span></p>
                <p class="message-content">
                    {{item.content}}
                </p>
                <div class="btn-pannel">
                    <span class="icon iconfont icon-reply reply-btn" v-on:click="selectMsg(item.id)"> {{item.reply_total}}</span>
                    <div class="float-right">
                    <span  class="icon iconfont icon-likes like-btn" v-on:click="like(item.id,index)"> {{item.like}}</span>
                    <span  class="icon iconfont icon-oppose  oppose-btn" v-on:click="oppose(item.id,index)"> {{item.oppose}}</span>
                    </div>
                </div>
            </el-card>
            <reply :replyTo="item.id" :role="role" :index="index" v-if="replyTo==item.id"></reply>

        </div>

        <br/>
        <el-pagination
                background
                layout="prev, pager, next"
                :total="items.length"
                :page-size="5"
                :current-page.sync="currentPage"
                class="text-center">
        </el-pagination>
    </div>
</template>

<script>
    import reply from './Reply'
    export default {
        mounted() {
            console.log('Message Component mounted.')

        },
        components:{
            reply
        },
        props: ['messages','role'],
        data() {
            return {
                isHidden: '1',
                dropdownName: '按时间由近及远',
                replyContent: '',
                items: this.messages,
                replyTo:0,
                currentPage:1,
                methods:'time',
                type:'1'

            }
        },
        methods: {
            handleCommand(command) {
                switch(command)
                {
                    case '1':
                        this.dropdownName='按点赞次数由多到少'
                        this.methods = 'like'
                        this.type = 1
                        this.sort()
                        break;
                    case '2':
                        this.dropdownName='按点赞次数由少到多'
                        this.methods = 'like'
                        this.type = 2
                        this.sort()

                        break;
                    case '3':
                        this.dropdownName='按时间由近及远'
                        this.methods = 'time'
                        this.type = 1
                        this.sort('time',1)
                        break;
                    case '4':
                        this.dropdownName='按时间由远及近'
                        this.methods = 'time'
                        this.type = 2
                        this.sort()

                        break;
                    default:
                        this.methods = 'time'
                        this.type = 1
                        this.dropdownName='按时间由近及远'
                        this.sort()
                }
                this.isHidden = command
            },

            selectMsg(id){
                (this.replyTo === id)?this.replyTo=0:this.replyTo=id;
            },
            sort(){
                let _this = this
                axios({
                    method: 'post',
                    url: '/msgSort',
                    data: {
                        methods: _this.methods,
                        type:_this.type
                    }
                })
                .then(function(response) {
                    _this.items = response.data
                })
                .catch(function (error) {
                    let errors = error.response.data.errors
                    console.log(errors)
                    let string = ''
                    if (errors.content.length===1){
                        string = errors.content[0]
                    }else{
                        for (x in errors.content){
                            string += errors.content[x]+','
                        }
                    }

                    _this.$message.error(string);
                });
            },
            pageShow(index){
                if ((index+1)>(this.currentPage-1)*5&&(index+1)<=(this.currentPage)*5){
                    return true;
                }else{
                    return false;
                }
            },
            like(id,index){
                let _this = this
                let oldCookie = _this.getCookie('likeId')
                _this.setCookie('likeId',id)
                let newCookie = _this.getCookie('likeId')
                if(oldCookie!==newCookie){
                    axios({
                        method: 'post',
                        url: '/like',
                        data: {
                            id:id
                        }
                    })
                        .then(function(response) {
                            _this.$message({
                                message: '已点赞',
                                type: 'success'
                            });
                            _this.items[index].like++
                        })
                        .catch(function (error) {

                        });
                }else {
                    _this.$message.error('你已经投过票了')
                }


            },
            oppose(id,index){
                let _this = this
                let oldCookie = _this.getCookie('opposeId')
                _this.setCookie('opposeId',id)
                let newCookie = _this.getCookie('opposeId')
                if(oldCookie!==newCookie){
                    axios({
                    method: 'post',
                    url: '/oppose',
                    data: {
                        id:id
                    }
                })
                    .then(function(response) {
                        _this.$message({
                            message: '已投反对',
                            type: 'success'
                        });
                        _this.items[index].oppose++
                    })
                    .catch(function (error) {

                    });
                }else {
                    _this.$message.error('你已经投过票了！！！')
                }
            },
            getCookie(name)
            {
                var arr,reg=new RegExp("(^| )"+name+"=([^;]*)(;|$)");

                if(arr=document.cookie.match(reg))

                    return unescape(arr[2]);
                else
                    return null;
            },
            setCookie(name,value)
            {
                var Days = 30;
                var exp = new Date();
                exp.setTime(exp.getTime() + Days*24*60*60*1000);
                document.cookie = name + "="+ escape (value) + ";expires=" + exp.toGMTString();
            }
        }
    }
</script>
