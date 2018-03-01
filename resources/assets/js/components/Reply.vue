<template>
    <transition name="el-zoom-in-top" >
        <el-form class="reply-pannel" v-for="">
            <el-form-item  prop="name">
                <el-input type="textarea" v-model="replyContent" :maxlength="140" :minlength="4" :rows="2"></el-input>
            </el-form-item>
            <div class="float-right">
                <el-form-item>
                    <el-button type="primary" @click="submitReply(replyTo,1)" v-if="role=='1'">管理员评论</el-button>
                    <el-button type="primary" @click="submitReply(replyTo,2)">匿名评论</el-button>
                </el-form-item>
            </div>
            <div class="clearfix"></div>
            <div class="replies">
                <div class="reply" v-for="item in items">
                    <p><span class="created_at">{{item.created_at}}</span><span v-if="item.type=='1'">由管理员评论</span></p>
                    <p>回复内容: <span class="content">{{item.content}}</span></p>
                </div>
            </div>
        </el-form>
    </transition>

</template>

<script>
    export default {
        mounted() {
            this.getReplies()
        },
        data() {
            return {
                replyContent: '',
                items:''
            }
        },
        props:['replyTo','role','index'],
        methods:{
            submitReply(id,type){
                let _this = this
                axios({
                    method: 'post',
                    url: '/reply',
                    data: {
                        id: id,
                        type:type,
                        contents:_this.replyContent
                    }
                })
                    .then(function(response) {
                        _this.getReplies()
                        _this.$parent.items[_this.index].reply_total++
                        _this.replyContent = ''
                        _this.$message('评论成功')
                    })
                    .catch(function (error) {
                        let errors = error.response
                        console.log(errors)
/*                        let string = ''
                        if (errors.content.length==1){
                            string = errors.content[0]
                        }else{
                            for (x in errors.content){
                                string += errors.content[x]+','
                            }
                        }

                        _this.$message.error(string);*/
                    });
            },
            getReplies(){
                let _this = this
                axios({
                    method: 'post',
                    url: '/replies',
                    data: {
                        id: this.replyTo,
                    }
                })
                    .then(function(response) {
                        _this.items = response.data
                    })
                    .catch(function (error) {
                        let errors = error.response.data.errors
                        console.log(errors)
                        let string = ''
                        if (errors.content.length==1){
                            string = errors.content[0]
                        }else{
                            for (x in errors.content){
                                string += errors.content[x]+','
                            }
                        }

                        _this.$message.error(string);
                    });
            }
        }
    }
</script>
