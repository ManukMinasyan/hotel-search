<template>
    <el-container>
        <el-header>
            <h1>Hotel Search Test</h1>
        </el-header>
        <el-main>
            <el-row>
                <el-col :span="24">
                    <Hotels/>
                </el-col>
            </el-row>
        </el-main>
    </el-container>
</template>

<script>
  import Hotels from '../views/Hotels'

  export default {
    name: 'App',
    components: { Hotels },
  }
</script>

<style scoped lang="scss">
    .el-header {
        background-color: #B3C0D1;
        color: #333;
        text-align: center;
        line-height: 60px;
        h1 {
            padding: 0;
            margin: 0;
        }
    }
</style>