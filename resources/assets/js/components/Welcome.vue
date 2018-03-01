<template>
    <div class="container" style="margin-top: 70px;">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="box-main">
                    <submit></submit>
                    <div class="clearfix"></div>
                    <message :messages="items" :usename="username" :role="role"></message>
                </div>

            </div>
        </div>
    </div>

</template>

<script>
    import submit from './Submit'
    import message from './Message'
    export default {
        mounted() {
            console.log('Welcome Component mounted.')
        },
        components:{
            submit, message
        },
        data(){
            return{
                items:eval('('+ this.messages+')'),

            }
        },
        props: ['messages','username','role'],
    }
</script>
