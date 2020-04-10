<template>
<div>
    <!-- Page-Title -->
        <div class="row">
                    <div class="col-sm-12">
                        <div class="page-title-box">
                            <div class="btn-group pull-right">
                                <ol class="breadcrumb hide-phone p-0 m-0">
                                    <li class="breadcrumb-item"><a href="#">工程实践28组</a></li>
                                    <li class="breadcrumb-item active">编辑页</li>
                                </ol>
                            </div>
                            <h4 class="page-title">编辑页</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title end breadcrumb -->
                <div class="row">
                    <div class="col-12">
                        <div class="card m-b-20">
                            <div class="card-body">

                                <h4 class="mt-0 header-title">基本信息</h4>
                                <p class="text-muted m-b-30 font-14">请在下方填写所有信息</p>

                                <form>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="productname">名称</label>
                                                <input id="productname" name="productname" type="text" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="manufacturername">编号</label>
                                                <input id="manufacturername" name="manufacturername" type="text" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="productdesc">详细信息</label>
                                                <textarea class="form-control" id="productdesc" rows="5"></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="manufacturerbrand">其他1</label>
                                                <input id="manufacturerbrand" name="manufacturerbrand" type="text" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="price">其他2</label>
                                                <input id="price" name="price" type="text" class="form-control">
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label">其他3</label>
                                                <select class="form-control select2">
                                                    <option>请选择</option>
                                                    <option value="teacher">老师</option>
                                                    <option value="student">学生</option>
                                                    <option value="manager">管理员</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">其他4</label>

                                                <select class="select2 form-control select2-multiple" multiple="multiple" data-placeholder="Choose ...">
                                                    <option value="teacher">老师</option>
                                                    <option value="student">学生</option>
                                                    <option value="manager">管理员</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>图片</label> <br/>
                                                <img src="assets/images/products/1.jpg" alt="product img" class="img-fluid" style="max-width: 200px;" />
                                                <br/>
                                                <button type="button" class="btn btn-purple m-t-10 waves-effect waves-light">确认更换</button>
                                            </div>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-success waves-effect waves-light">保存修改</button>
                                    <button type="submit" class="btn btn-secondary waves-effect">取消</button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- end container -->
        <!-- end wrapper -->
</template>
<script>
export default {
  name: 'Edit',
  data () {
    return {
    }
  },
  created () {
  },
  methods: {
    // 关闭载入动画的函数

  }
}
</script>
