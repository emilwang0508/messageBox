<template>
    <div class="class">
        <textarea class="form-control" rows="3"></textarea>
        <br>
        <div class="float-right">
            <div class="checkbox">
                <label>
                    <input type="checkbox" checked>匿名
                </label>
                <button type="submit" class="btn btn-default ">Submit</button>
            </div>

        </div>
        <br>
        <br>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Submit Component mounted.')
        }
    }
</script>
