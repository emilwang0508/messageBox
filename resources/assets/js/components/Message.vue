<template>
    <div class="message-pannel">
        <div class="message-header">
            <div class="float-right">
                <el-dropdown @command="handleCommand">
                    <span class="el-dropdown-link">
                    {{dropdownName}}<i class="el-icon-arrow-down el-icon--right"></i>
                    </span>
                    <el-dropdown-menu slot="dropdown">
                        <el-dropdown-item command="1">按点赞次数由多到少</el-dropdown-item>
                        <el-dropdown-item command="2">按点赞次数由少到多</el-dropdown-item>
                        <el-dropdown-item command="3">按时间正序</el-dropdown-item>
                        <el-dropdown-item command="4">按时间倒叙</el-dropdown-item>
                    </el-dropdown-menu>
                </el-dropdown>
            </div>
            <br>
        </div>
        <el-card class="box-card message clearfix">
            <p><span class="created_at">2018-02-08 16:53:00</span><span class="username">匿名公开</span></p>
            <p class="message-content">hello, messagehello, messagehello, messagehello, messagehello, messagehello, messagehello, messagehello, messagehello, messagehello, messagehello, messagehello, messagehello, messagehello, messagehello, messagehello, messagehello, messagehello, messagehello, messagehello, messagehello, messagehello, messagehello, messagehello, message
            </p>
            <div><span class="icon iconfont icon-reply"> 0</span><span  class="icon iconfont icon-likes float-right like-btn"> 999</span><span  class="icon iconfont icon-oppose float-right oppose-btn"> 999</span></div>
        </el-card>
        <el-form class="reply-pannel">
            <el-form-item  prop="name">
                <el-input v-model="content"></el-input>
            </el-form-item>
            <div class="float-right">
            <el-form-item>
                <el-button type="primary" @click="submitReply()">管理员评论</el-button>
                <el-button type="primary" @click="submitReply()">匿名评论</el-button>
            </el-form-item>
            </div>
            <div class="clearfix"></div>
            <div class="replies">
                <div class="reply">
                    <p><span class="created_at">2018-02-28 16:30:00</span><span>由管理员评论</span></p>
                    <p>回复内容: <span class="content">吧啦啦啦</span></p>
                </div>
                <div class="reply">
                    <p><span class="created_at">2018-02-28 16:30:00</span><span></span></p>
                    <p>回复内容: <span class="content">吧啦啦啦</span></p>
                </div>
            </div>
        </el-form>
        <el-card class="box-card message clearfix">
            <p><span class="created_at">2018-02-08 16:53:00</span><span class="username">匿名不公开</span></p>
            <p class="message-content">hello, messagehello, messagehello, messagehello, messagehello, messagehello, messagehello, messagehello, messagehello, messagehello, messagehello, messagehello, messagehello, messagehello, messagehello, messagehello, messagehello, messagehello, messagehello, messagehello, messagehello, messagehello, messagehello, messagehello, message
            </p>
        </el-card>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        },
        data() {
            return {
                isHidden: '1',
                dropdownName: '按点赞次数由多到少',
                content: ''
            }
        },
        methods: {
            handleCommand(command) {
                switch(command)
                {
                    case '1':
                        this.dropdownName='按点赞次数由多到少'
                        break;
                    case '2':
                        this.dropdownName='按点赞次数由少到多'
                        break;
                    case '3':
                        this.dropdownName='按时间正序'
                        break;
                    case '4':
                        this.dropdownName='按时间倒序'
                        break;
                    default:
                        this.dropdownName='按点赞次数由多到少'
                }
                this.isHidden = command
                console.log(this.isHidden)
                console.log(this.dropdownName)
            },
            submitReply(){

            }
        }
    }
</script>
