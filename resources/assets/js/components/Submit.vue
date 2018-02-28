<template>
    <div class="class">
        <el-form>
        <el-form-item>
            <el-input type="textarea" v-model="content"></el-input>
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
            <el-button type="primary">匿名提交</el-button>
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
                content:'',
                isHidden: '1',
                dropdownName:'不公开'
            }
        },
        methods: {
            handleCommand(command) {
                command=='1'?this.dropdownName='不公开':this.dropdownName = '公开'
                this.isHidden = command
            }
        }
    }
</script>
