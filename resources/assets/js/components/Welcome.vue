<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <submit></submit>
                <br>
                <div class="clearfix"></div>
                <br>
                <message></message>
            </div>
        </div>
    </div>

</template>

<script>
    import submit from './Submit'
    import message from './Message'
    export default {
        mounted() {
            console.log('Component mounted.')
        },
        components:{
            submit, message
        }
    }
</script>
