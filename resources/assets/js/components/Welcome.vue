<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <submit></submit>
                <div class="message">
                    <p><img src="/img/demoAvatar.png" alt="avatar" class="img-circle headpic"><span class="username">匿名</span></p>
                    <p class="message-content">hello, messagehello, messagehello, messagehello, messagehello, messagehello, messagehello, messagehello, messagehello, messagehello, messagehello, messagehello, messagehello, messagehello, messagehello, messagehello, messagehello, messagehello, messagehello, messagehello, messagehello, messagehello, messagehello, messagehello, message
                    </p>
                </div>
                <div class="message">
                    <p><img src="/img/demoAvatar.png" alt="avatar" class="img-circle headpic"><span class="username">匿名</span></p>
                    <p class="message-content">hello, messagehello, messagehello, messagehello, messagehello, messagehello, messagehello, messagehello, messagehello, messagehello, messagehello, messagehello, messagehello, messagehello, messagehello, messagehello, messagehello, messagehello, messagehello, messagehello, messagehello, messagehello, messagehello, messagehello, message
                    </p>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
    import submit from './Submit'
    export default {
        mounted() {
            console.log('Component mounted.')
        },
        components:{
            submit
        }
    }
</script>
