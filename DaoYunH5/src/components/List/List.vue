<template>
  <div class="wrapper">
    <div class="container-fluid">
      <!-- Page-Title -->
      <div class="row">
        <div class="col-sm-12">
          <div class="page-title-box">
            <div class="btn-group pull-right">
              <ol class="breadcrumb hide-phone p-0 m-0">
                <li class="breadcrumb-item"><a href="#">28</a></li>
                <li class="breadcrumb-item active">列表页</li>
              </ol>
            </div>
            <h4 class="page-title">列表页</h4>
          </div>
        </div>
      </div>
      <!-- end page title end breadcrumb -->

      <div class="row">
        <div class="col-12">
          <div class="card m-b-20">
            <div class="card-body">
              <table
                id="datatable"
                class="table table-striped dt-responsive nowrap table-vertical"
                width="100%"
                cellspacing="0"
              >
                <thead>
                  <tr>
                    <th>图片</th>
                    <th>名称</th>
                    <th>时间</th>
                    <th>数量</th>
                    <th>编号</th>
                    <th>进度</th>
                    <th>操作</th>
                  </tr>
                </thead>
                <!-- <tbody>
                  <tr>
                    <td class="product-list-img">
                      <img
                        src="assets/images/products/1.jpg"
                        class="img-fluid"
                        alt="tbl"
                      />
                    </td>
                    <td>
                      <h6 class="mt-0 m-b-5">Riverston Glass Chair</h6>
                      <p class="m-0 font-14">
                        Lorem ipsum dolor sit consec te imperdiet iaculis
                        ipsum..
                      </p>
                    </td>
                    <td>20/03/2019</td>
                    <td>521</td>
                    <td>5841</td>
                    <td>
                      <div class="progress" style="height: 5px;">
                        <div
                          class="progress-bar bg-danger"
                          role="progressbar"
                          style="width: 25%;"
                          aria-valuenow="25"
                          aria-valuemin="0"
                          aria-valuemax="100"
                        ></div>
                      </div>
                    </td>
                    <td>
                      <a
                        href="javascript:void(0);"
                        class="m-r-15 text-muted"
                        data-toggle="tooltip"
                        data-placement="top"
                        title=""
                        data-original-title="Edit"
                        ><i class="mdi mdi-pencil font-18"></i
                      ></a>
                      <a
                        href="javascript:void(0);"
                        class="text-muted"
                        data-toggle="tooltip"
                        data-placement="top"
                        title=""
                        data-original-title="Delete"
                        ><i class="mdi mdi-close font-18"></i
                      ></a>
                    </td>
                  </tr>

                  <tr>
                    <td class="product-list-img">
                      <img
                        src="assets/images/products/2.jpg"
                        class="img-fluid"
                        alt="tbl"
                      />
                    </td>
                    <td>
                      <h6 class="mt-0 m-b-5">Shine Company Catalina</h6>
                      <p class="m-0 font-14">
                        Lorem ipsum dolor sit consec te imperdiet iaculis
                        ipsum..
                      </p>
                    </td>
                    <td>19/03/2019</td>
                    <td>210</td>
                    <td>841</td>
                    <td>
                      <div class="progress" style="height: 5px;">
                        <div
                          class="progress-bar bg-success"
                          role="progressbar"
                          style="width: 85%;"
                          aria-valuenow="25"
                          aria-valuemin="0"
                          aria-valuemax="100"
                        ></div>
                      </div>
                    </td>
                    <td>
                      <a
                        href="javascript:void(0);"
                        class="m-r-15 text-muted"
                        data-toggle="tooltip"
                        data-placement="top"
                        title=""
                        data-original-title="Edit"
                        ><i class="mdi mdi-pencil font-18"></i
                      ></a>
                      <a
                        href="javascript:void(0);"
                        class="text-muted"
                        data-toggle="tooltip"
                        data-placement="top"
                        title=""
                        data-original-title="Delete"
                        ><i class="mdi mdi-close font-18"></i
                      ></a>
                    </td>
                  </tr>

                  <tr>
                    <td class="product-list-img">
                      <img
                        src="assets/images/products/3.jpg"
                        class="img-fluid"
                        alt="tbl"
                      />
                    </td>
                    <td>
                      <h6 class="mt-0 m-b-5">Trex Outdoor Furniture Cape</h6>
                      <p class="m-0 font-14">
                        Lorem ipsum dolor sit consec te imperdiet iaculis
                        ipsum..
                      </p>
                    </td>
                    <td>18/03/2019</td>
                    <td>652</td>
                    <td>120</td>
                    <td>
                      <div class="progress" style="height: 5px;">
                        <div
                          class="progress-bar bg-danger"
                          role="progressbar"
                          style="width: 35%;"
                          aria-valuenow="25"
                          aria-valuemin="0"
                          aria-valuemax="100"
                        ></div>
                      </div>
                    </td>
                    <td>
                      <a
                        href="javascript:void(0);"
                        class="m-r-15 text-muted"
                        data-toggle="tooltip"
                        data-placement="top"
                        title=""
                        data-original-title="Edit"
                        ><i class="mdi mdi-pencil font-18"></i
                      ></a>
                      <a
                        href="javascript:void(0);"
                        class="text-muted"
                        data-toggle="tooltip"
                        data-placement="top"
                        title=""
                        data-original-title="Delete"
                        ><i class="mdi mdi-close font-18"></i
                      ></a>
                    </td>
                  </tr>
                  <tr>
                    <td class="product-list-img">
                      <img
                        src="assets/images/products/4.jpg"
                        class="img-fluid"
                        alt="tbl"
                      />
                    </td>
                    <td>
                      <h6 class="mt-0 m-b-5">Oasis Bathroom Teak Corner</h6>
                      <p class="m-0 font-14">
                        Lorem ipsum dolor sit consec te imperdiet iaculis
                        ipsum..
                      </p>
                    </td>
                    <td>17/03/2019</td>
                    <td>85</td>
                    <td>320</td>
                    <td>
                      <div class="progress" style="height: 5px;">
                        <div
                          class="progress-bar bg-info"
                          role="progressbar"
                          style="width: 65%;"
                          aria-valuenow="25"
                          aria-valuemin="0"
                          aria-valuemax="100"
                        ></div>
                      </div>
                    </td>
                    <td>
                      <a
                        href="javascript:void(0);"
                        class="m-r-15 text-muted"
                        data-toggle="tooltip"
                        data-placement="top"
                        title=""
                        data-original-title="Edit"
                        ><i class="mdi mdi-pencil font-18"></i
                      ></a>
                      <a
                        href="javascript:void(0);"
                        class="text-muted"
                        data-toggle="tooltip"
                        data-placement="top"
                        title=""
                        data-original-title="Delete"
                        ><i class="mdi mdi-close font-18"></i
                      ></a>
                    </td>
                  </tr>
                  <tr>
                    <td class="product-list-img">
                      <img
                        src="assets/images/products/5.jpg"
                        class="img-fluid"
                        alt="tbl"
                      />
                    </td>
                    <td>
                      <h6 class="mt-0 m-b-5">Condimentum Posuere</h6>
                      <p class="m-0 font-14">
                        Lorem ipsum dolor sit consec te imperdiet iaculis
                        ipsum..
                      </p>
                    </td>
                    <td>16/03/2019</td>
                    <td>8512</td>
                    <td>201</td>
                    <td>
                      <div class="progress" style="height: 5px;">
                        <div
                          class="progress-bar bg-success"
                          role="progressbar"
                          style="width: 79%;"
                          aria-valuenow="25"
                          aria-valuemin="0"
                          aria-valuemax="100"
                        ></div>
                      </div>
                    </td>
                    <td>
                      <a
                        href="javascript:void(0);"
                        class="m-r-15 text-muted"
                        data-toggle="tooltip"
                        data-placement="top"
                        title=""
                        data-original-title="Edit"
                        ><i class="mdi mdi-pencil font-18"></i
                      ></a>
                      <a
                        href="javascript:void(0);"
                        class="text-muted"
                        data-toggle="tooltip"
                        data-placement="top"
                        title=""
                        data-original-title="Delete"
                        ><i class="mdi mdi-close font-18"></i
                      ></a>
                    </td>
                  </tr>
                  <tr>
                    <td class="product-list-img">
                      <img
                        src="assets/images/products/6.jpg"
                        class="img-fluid"
                        alt="tbl"
                      />
                    </td>
                    <td>
                      <h6 class="mt-0 m-b-5">Micro Board</h6>
                      <p class="m-0 font-14">
                        Lorem ipsum dolor sit consec te imperdiet iaculis
                        ipsum..
                      </p>
                    </td>
                    <td>15/03/2019</td>
                    <td>521</td>
                    <td>321</td>
                    <td>
                      <div class="progress" style="height: 5px;">
                        <div
                          class="progress-bar bg-warning"
                          role="progressbar"
                          style="width: 40%;"
                          aria-valuenow="25"
                          aria-valuemin="0"
                          aria-valuemax="100"
                        ></div>
                      </div>
                    </td>
                    <td>
                      <a
                        href="javascript:void(0);"
                        class="m-r-15 text-muted"
                        data-toggle="tooltip"
                        data-placement="top"
                        title=""
                        data-original-title="Edit"
                        ><i class="mdi mdi-pencil font-18"></i
                      ></a>
                      <a
                        href="javascript:void(0);"
                        class="text-muted"
                        data-toggle="tooltip"
                        data-placement="top"
                        title=""
                        data-original-title="Delete"
                        ><i class="mdi mdi-close font-18"></i
                      ></a>
                    </td>
                  </tr>
                  <tr>
                    <td class="product-list-img">
                      <img
                        src="assets/images/products/7.jpg"
                        class="img-fluid"
                        alt="tbl"
                      />
                    </td>
                    <td>
                      <h6 class="mt-0 m-b-5">BeoPlay Speaker</h6>
                      <p class="m-0 font-14">
                        Lorem ipsum dolor sit consec te imperdiet iaculis
                        ipsum..
                      </p>
                    </td>
                    <td>16/03/2019</td>
                    <td>22</td>
                    <td>5410</td>
                    <td>
                      <div class="progress" style="height: 5px;">
                        <div
                          class="progress-bar bg-success"
                          role="progressbar"
                          style="width: 95%;"
                          aria-valuenow="25"
                          aria-valuemin="0"
                          aria-valuemax="100"
                        ></div>
                      </div>
                    </td>
                    <td>
                      <a
                        href="javascript:void(0);"
                        class="m-r-15 text-muted"
                        data-toggle="tooltip"
                        data-placement="top"
                        title=""
                        data-original-title="Edit"
                        ><i class="mdi mdi-pencil font-18"></i
                      ></a>
                      <a
                        href="javascript:void(0);"
                        class="text-muted"
                        data-toggle="tooltip"
                        data-placement="top"
                        title=""
                        data-original-title="Delete"
                        ><i class="mdi mdi-close font-18"></i
                      ></a>
                    </td>
                  </tr>
                  <tr>
                    <td class="product-list-img">
                      <img
                        src="assets/images/products/8.jpg"
                        class="img-fluid"
                        alt="tbl"
                      />
                    </td>
                    <td>
                      <h6 class="mt-0 m-b-5">Travelers Leather Bag</h6>
                      <p class="m-0 font-14">
                        Lorem ipsum dolor sit consec te imperdiet iaculis
                        ipsum..
                      </p>
                    </td>
                    <td>17/03/2019</td>
                    <td>98</td>
                    <td>556</td>
                    <td>
                      <div class="progress" style="height: 5px;">
                        <div
                          class="progress-bar bg-warning"
                          role="progressbar"
                          style="width: 45%;"
                          aria-valuenow="25"
                          aria-valuemin="0"
                          aria-valuemax="100"
                        ></div>
                      </div>
                    </td>
                    <td>
                      <a
                        href="javascript:void(0);"
                        class="m-r-15 text-muted"
                        data-toggle="tooltip"
                        data-placement="top"
                        title=""
                        data-original-title="Edit"
                        ><i class="mdi mdi-pencil font-18"></i
                      ></a>
                      <a
                        href="javascript:void(0);"
                        class="text-muted"
                        data-toggle="tooltip"
                        data-placement="top"
                        title=""
                        data-original-title="Delete"
                        ><i class="mdi mdi-close font-18"></i
                      ></a>
                    </td>
                  </tr>
                  <tr>
                    <td class="product-list-img">
                      <img
                        src="assets/images/products/1.jpg"
                        class="img-fluid"
                        alt="tbl"
                      />
                    </td>
                    <td>
                      <h6 class="mt-0 m-b-5">Riverston Glass Chair</h6>
                      <p class="m-0 font-14">
                        Lorem ipsum dolor sit consec te imperdiet iaculis
                        ipsum..
                      </p>
                    </td>
                    <td>18/03/2019</td>
                    <td>521</td>
                    <td>5841</td>
                    <td>
                      <div class="progress" style="height: 5px;">
                        <div
                          class="progress-bar bg-danger"
                          role="progressbar"
                          style="width: 25%;"
                          aria-valuenow="25"
                          aria-valuemin="0"
                          aria-valuemax="100"
                        ></div>
                      </div>
                    </td>
                    <td>
                      <a
                        href="javascript:void(0);"
                        class="m-r-15 text-muted"
                        data-toggle="tooltip"
                        data-placement="top"
                        title=""
                        data-original-title="Edit"
                        ><i class="mdi mdi-pencil font-18"></i
                      ></a>
                      <a
                        href="javascript:void(0);"
                        class="text-muted"
                        data-toggle="tooltip"
                        data-placement="top"
                        title=""
                        data-original-title="Delete"
                        ><i class="mdi mdi-close font-18"></i
                      ></a>
                    </td>
                  </tr>

                  <tr>
                    <td class="product-list-img">
                      <img
                        src="assets/images/products/2.jpg"
                        class="img-fluid"
                        alt="tbl"
                      />
                    </td>
                    <td>
                      <h6 class="mt-0 m-b-5">Shine Company Catalina</h6>
                      <p class="m-0 font-14">
                        Lorem ipsum dolor sit consec te imperdiet iaculis
                        ipsum..
                      </p>
                    </td>
                    <td>19/03/2019</td>
                    <td>210</td>
                    <td>841</td>
                    <td>
                      <div class="progress" style="height: 5px;">
                        <div
                          class="progress-bar bg-success"
                          role="progressbar"
                          style="width: 85%;"
                          aria-valuenow="25"
                          aria-valuemin="0"
                          aria-valuemax="100"
                        ></div>
                      </div>
                    </td>
                    <td>
                      <a
                        href="javascript:void(0);"
                        class="m-r-15 text-muted"
                        data-toggle="tooltip"
                        data-placement="top"
                        title=""
                        data-original-title="Edit"
                        ><i class="mdi mdi-pencil font-18"></i
                      ></a>
                      <a
                        href="javascript:void(0);"
                        class="text-muted"
                        data-toggle="tooltip"
                        data-placement="top"
                        title=""
                        data-original-title="Delete"
                        ><i class="mdi mdi-close font-18"></i
                      ></a>
                    </td>
                  </tr>

                  <tr>
                    <td class="product-list-img">
                      <img
                        src="assets/images/products/3.jpg"
                        class="img-fluid"
                        alt="tbl"
                      />
                    </td>
                    <td>
                      <h6 class="mt-0 m-b-5">Trex Outdoor Furniture Cape</h6>
                      <p class="m-0 font-14">
                        Lorem ipsum dolor sit consec te imperdiet iaculis
                        ipsum..
                      </p>
                    </td>
                    <td>20/03/2019</td>
                    <td>652</td>
                    <td>120</td>
                    <td>
                      <div class="progress" style="height: 5px;">
                        <div
                          class="progress-bar bg-danger"
                          role="progressbar"
                          style="width: 35%;"
                          aria-valuenow="25"
                          aria-valuemin="0"
                          aria-valuemax="100"
                        ></div>
                      </div>
                    </td>
                    <td>
                      <a
                        href="javascript:void(0);"
                        class="m-r-15 text-muted"
                        data-toggle="tooltip"
                        data-placement="top"
                        title=""
                        data-original-title="Edit"
                        ><i class="mdi mdi-pencil font-18"></i
                      ></a>
                      <a
                        href="javascript:void(0);"
                        class="text-muted"
                        data-toggle="tooltip"
                        data-placement="top"
                        title=""
                        data-original-title="Delete"
                        ><i class="mdi mdi-close font-18"></i
                      ></a>
                    </td>
                  </tr>
                  <tr>
                    <td class="product-list-img">
                      <img
                        src="assets/images/products/4.jpg"
                        class="img-fluid"
                        alt="tbl"
                      />
                    </td>
                    <td>
                      <h6 class="mt-0 m-b-5">Oasis Bathroom Teak Corner</h6>
                      <p class="m-0 font-14">
                        Lorem ipsum dolor sit consec te imperdiet iaculis
                        ipsum..
                      </p>
                    </td>
                    <td>19/03/2019</td>
                    <td>85</td>
                    <td>320</td>
                    <td>
                      <div class="progress" style="height: 5px;">
                        <div
                          class="progress-bar bg-info"
                          role="progressbar"
                          style="width: 65%;"
                          aria-valuenow="25"
                          aria-valuemin="0"
                          aria-valuemax="100"
                        ></div>
                      </div>
                    </td>
                    <td>
                      <a
                        href="javascript:void(0);"
                        class="m-r-15 text-muted"
                        data-toggle="tooltip"
                        data-placement="top"
                        title=""
                        data-original-title="Edit"
                        ><i class="mdi mdi-pencil font-18"></i
                      ></a>
                      <a
                        href="javascript:void(0);"
                        class="text-muted"
                        data-toggle="tooltip"
                        data-placement="top"
                        title=""
                        data-original-title="Delete"
                        ><i class="mdi mdi-close font-18"></i
                      ></a>
                    </td>
                  </tr>
                  <tr>
                    <td class="product-list-img">
                      <img
                        src="assets/images/products/5.jpg"
                        class="img-fluid"
                        alt="tbl"
                      />
                    </td>
                    <td>
                      <h6 class="mt-0 m-b-5">Condimentum Posuere</h6>
                      <p class="m-0 font-14">
                        Lorem ipsum dolor sit consec te imperdiet iaculis
                        ipsum..
                      </p>
                    </td>
                    <td>18/03/2019</td>
                    <td>8512</td>
                    <td>201</td>
                    <td>
                      <div class="progress" style="height: 5px;">
                        <div
                          class="progress-bar bg-success"
                          role="progressbar"
                          style="width: 79%;"
                          aria-valuenow="25"
                          aria-valuemin="0"
                          aria-valuemax="100"
                        ></div>
                      </div>
                    </td>
                    <td>
                      <a
                        href="javascript:void(0);"
                        class="m-r-15 text-muted"
                        data-toggle="tooltip"
                        data-placement="top"
                        title=""
                        data-original-title="Edit"
                        ><i class="mdi mdi-pencil font-18"></i
                      ></a>
                      <a
                        href="javascript:void(0);"
                        class="text-muted"
                        data-toggle="tooltip"
                        data-placement="top"
                        title=""
                        data-original-title="Delete"
                        ><i class="mdi mdi-close font-18"></i
                      ></a>
                    </td>
                  </tr>
                  <tr>
                    <td class="product-list-img">
                      <img
                        src="assets/images/products/6.jpg"
                        class="img-fluid"
                        alt="tbl"
                      />
                    </td>
                    <td>
                      <h6 class="mt-0 m-b-5">Micro Board</h6>
                      <p class="m-0 font-14">
                        Lorem ipsum dolor sit consec te imperdiet iaculis
                        ipsum..
                      </p>
                    </td>
                    <td>17/03/2019</td>
                    <td>521</td>
                    <td>321</td>
                    <td>
                      <div class="progress" style="height: 5px;">
                        <div
                          class="progress-bar bg-warning"
                          role="progressbar"
                          style="width: 40%;"
                          aria-valuenow="25"
                          aria-valuemin="0"
                          aria-valuemax="100"
                        ></div>
                      </div>
                    </td>
                    <td>
                      <a
                        href="javascript:void(0);"
                        class="m-r-15 text-muted"
                        data-toggle="tooltip"
                        data-placement="top"
                        title=""
                        data-original-title="Edit"
                        ><i class="mdi mdi-pencil font-18"></i
                      ></a>
                      <a
                        href="javascript:void(0);"
                        class="text-muted"
                        data-toggle="tooltip"
                        data-placement="top"
                        title=""
                        data-original-title="Delete"
                        ><i class="mdi mdi-close font-18"></i
                      ></a>
                    </td>
                  </tr>
                  <tr>
                    <td class="product-list-img">
                      <img
                        src="assets/images/products/7.jpg"
                        class="img-fluid"
                        alt="tbl"
                      />
                    </td>
                    <td>
                      <h6 class="mt-0 m-b-5">BeoPlay Speaker</h6>
                      <p class="m-0 font-14">
                        Lorem ipsum dolor sit consec te imperdiet iaculis
                        ipsum..
                      </p>
                    </td>
                    <td>16/03/2019</td>
                    <td>22</td>
                    <td>5410</td>
                    <td>
                      <div class="progress">
                        <div
                          class="progress-bar bg-success"
                          role="progressbar"
                          style="width: 95%; height: 5px;"
                          aria-valuenow="25"
                          aria-valuemin="0"
                          aria-valuemax="100"
                        ></div>
                      </div>
                    </td>
                    <td>
                      <a
                        href="javascript:void(0);"
                        class="m-r-15 text-muted"
                        data-toggle="tooltip"
                        data-placement="top"
                        title=""
                        data-original-title="Edit"
                        ><i class="mdi mdi-pencil font-18"></i
                      ></a>
                      <a
                        href="javascript:void(0);"
                        class="text-muted"
                        data-toggle="tooltip"
                        data-placement="top"
                        title=""
                        data-original-title="Delete"
                        ><i class="mdi mdi-close font-18"></i
                      ></a>
                    </td>
                  </tr>
                  <tr>
                    <td class="product-list-img">
                      <img
                        src="assets/images/products/8.jpg"
                        class="img-fluid"
                        alt="tbl"
                      />
                    </td>
                    <td>
                      <h6 class="mt-0 m-b-5">Travelers Leather Bag</h6>
                      <p class="m-0 font-14">
                        Lorem ipsum dolor sit consec te imperdiet iaculis
                        ipsum..
                      </p>
                    </td>
                    <td>15/03/2019</td>
                    <td>98</td>
                    <td>556</td>
                    <td>
                      <div class="progress" style="height: 5px;">
                        <div
                          class="progress-bar bg-warning"
                          role="progressbar"
                          style="width: 45%;"
                          aria-valuenow="25"
                          aria-valuemin="0"
                          aria-valuemax="100"
                        ></div>
                      </div>
                    </td>
                    <td>
                      <a
                        href="javascript:void(0);"
                        class="m-r-15 text-muted"
                        data-toggle="tooltip"
                        data-placement="top"
                        title=""
                        data-original-title="Edit"
                        ><i class="mdi mdi-pencil font-18"></i
                      ></a>
                      <a
                        href="javascript:void(0);"
                        class="text-muted"
                        data-toggle="tooltip"
                        data-placement="top"
                        title=""
                        data-original-title="Delete"
                        ><i class="mdi mdi-close font-18"></i
                      ></a>
                    </td>
                  </tr>！
                </tbody> -->
                <router-view></router-view>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- end container -->
  </div>
  <!-- end wrapper -->
</template>
<script>
export default {
  name: 'List',
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
