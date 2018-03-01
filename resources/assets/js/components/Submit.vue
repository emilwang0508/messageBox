<template>
    <div class="class">
        <el-form>
            <p>说出你的想法，让公司建设更加完善</p>
        <el-form-item>
            <el-input type="textarea" v-model="contents" :maxlength="140" :minlength="4" :rows="4" placeholder="你有什么建议？？？"></el-input>
        </el-form-item>
        </el-form>
        <br>
        <div class="float-right">
            <el-dropdown @command="handleCommand">
            <span class="el-dropdown-link">
                {{dropdownName}}<i class="el-icon-arrow-down el-icon--right"></i>
                </span>
                <el-dropdown-menu slot="dropdown">
                    <el-dropdown-item command="1">不公开</el-dropdown-item>
                    <el-dropdown-item command="2">公开</el-dropdown-item>
                </el-dropdown-menu>
            </el-dropdown>
            <el-button type="primary" v-on:click="submitMsg()">匿名提交</el-button>
        </div>
        <br>
        <br>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Submit Component mounted.')
        },
        data(){
            return {
                options: [{
                    value: '1',
                    label: '不公开'
                }, {
                    value: '2',
                    label: '公开'
                }],
                contents:'',
                isHidden: '1',
                dropdownName:'不公开'
            }
        },
        methods: {
            handleCommand(command) {
                command=='1'?this.dropdownName='不公开':this.dropdownName = '公开'
                this.isHidden = command
            },
            submitMsg(){
                let data = new Array()
                let _this = this
                axios({
                    method: 'post',
                    url: '/message',
                    data: {
                        contents: this.contents,
                        type: this.isHidden
                    }
                })
                    .then(function(response) {
                        _this.$message('提交成功，感谢你的留言')
                        _this.contents = ''
                        _this.$parent.$children[1].sort()
                    })
                    .catch(function (error) {
                        let errors = error.response.data.errors
                        console.log(errors)
                        let string = ''
                        if (errors.contents.length==1){
                            string = errors.contents[0]
                        }else{
                            for (x in errors.contents){
                                string += errors.contents[x]+','
                            }
                        }

                        _this.$message.error(string);
                    });

            }
        }
    }
</script>
