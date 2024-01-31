<style>
    td div a:hover i {
        font-size: 20px;
        transition: .3s ease-out;
    }
</style>
<div id="main-content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <h2>Danh sách Sản Phẩm</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo ROOT_URL . 'dashboard' ?>"><i
                                    class="fa fa-dashboard"></i></a></li>
                        <li class="breadcrumb-item">Dashboard</li>
                        <li class="breadcrumb-item">Sản Phẩm</li>
                        <li class="breadcrumb-item active">Danh sách</li>
                    </ul>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="d-flex flex-row-reverse">
                        <div class="page_action">
                            <a href="#addModal" data-toggle="modal" data-target="#addModal">
                                <button type="button" class="btn btn-primary"><i class="fa fa-plus"></i>
                                    Thêm</button>
                            </a>
                        </div>
                        <div class="p-2 d-flex">

                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="row clearfix">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="header">
                        <h2>Danh sách</h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th style="width:60px;">#</th>
                                        <th>Sản Phẩm</th>
                                        <th class="text-center">Hình Ảnh</th>
                                        <th class="text-center">Album</th>
                                        <th class="col-2 text-center">Chức năng</th>
                                    </tr>
                                </thead>

                                <tbody>

                                    <?php
                                    $dataArr = json_decode($data, true);
                                    if (!empty($dataArr)) {
                                        foreach ($dataArr as $key => $item) {
                                            ?>

                                            <tr>
                                                <td>
                                                    <?= $key + 1 ?>
                                                </td>
                                                <td>
                                                    <?= $item['name'] ?>
                                                </td>

                                                <td class="text-center"><img class="col-6 img-fluid"
                                                        src="<?= PUBLIC_URL ?>ct_shop/uploads/products/images/<?= $item['image'] ?>"
                                                        alt="<?= $item['name'] ?>" title=" <?= $item['alias'] ?> ">
                                                </td>

                                                <td class="text-center"><img class="col-4 img-fluid"
                                                        src="<?= PUBLIC_URL ?>ct_shop/uploads/products/images/<?= $item['album'] ?>"
                                                        alt="<?= $item['name'] ?>" title=" <?= $item['alias'] ?> ">
                                                </td>

                                                <td>
                                                    <div class="d-flex justify-content-around">
                                                        <a id="viewModalBtn" href="#viewModal" data-toggle="modal"
                                                            data-target="#viewModal" value="<?= $item['id'] ?>" title="Xem">
                                                            <i class="fa fa-search"></i>
                                                        </a>

                                                        <a id="editModalBtn" href="#editModal" data-toggle="modal"
                                                            data-target="#editModal" value="<?= $item['id'] ?>" title="Sửa">
                                                            <i class="fa fa-edit text-secondary"></i>
                                                        </a>

                                                        <a href="" title="Xóa" data-itemid="<?= $item['id'] ?>"
                                                            onclick="deleteItem(event)">
                                                            <i class="fa fa-trash-o text-danger"></i>
                                                        </a>
                                                    </div>

                                                </td>
                                            </tr>

                                            <?php
                                        }
                                    } else { ?>

                                        <tr>
                                            <td colspan="5" class="text-center mt-2 h6 text-danger">Không có Sản Phẩm</td>
                                        </tr>

                                        <?php
                                    }
                                    ?>

                                </tbody>
                            </table>

                            <?php
                            if (!empty($dataArr)) {
                                ?>

                                <div class="col-12 pt-4 btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                                    <div class="col-12 btn-group d-flex justify-content-center m-auto" role="group"
                                        aria-label="First group">
                                        <?php
                                        for ($i = 1; $i <= $listPage; $i++) { ?>
                                            <a class="paginationBtn"
                                                href="http://localhost/ct_shop/dashboard/products/list?page=<?php echo $i ?>">
                                                <!-- <button type="submit" class="btn btn-secondary"> -->
                                                <?php echo $i ?>
                                                <!-- </button> -->
                                            </a>
                                        <?php } ?>
                                    </div>
                                </div>

                                <?php
                            }
                            ?>


                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            let data = <?php echo $data; ?>;
        </script>

        <!-- Default Size -->
        <div class="modal fade" id="viewModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="title" id="viewModalLabel"></h4>
                    </div>
                    <div class="modal-body">

                        <div class="card">

                            <div class="body">
                                <ul class=" list-unstyled basic-list">
                                    <li>ID <span class="badge">21</span></li>
                                    <li>Tên Sản Phẩm <span class="badge">Hossein</span></li>
                                    <li>Alias<span class="badge">Hossein</span></li>
                                    <li>Keyword<span class="badge text-wrap text-justify pb-4">Hos seinH osse inHos
                                            seinHosse inHosseinHo sseinHossein HosseinHosse inHosseinHosse
                                            inHosseinHosseinHosseinHossein</span></li>
                                    <li>Description<span class="badge text-wrap text-justify pb-4">Hos seinH osse inHos
                                            seinHosse inHosseinHo sseinHossein HosseinHosse inHosseinHosse
                                            inHosseinHosseinHosseinHossein</span></li>
                                    <li>Trạng thái<span class="badge">Hossein</span></li>
                                    <li>Ngày tạo<span class="badge">Hossein</span></li>
                                    <li>Ngày cập nhật<span class="badge">Hossein</span></li>
                                </ul>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Đóng</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- LargeSize -->
        <div class="modal fade" id="addModal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="title" id="addModalLabel">Tạo Sản Phẩm</h4>
                    </div>
                    <div class="modal-body">
                        <div class="">
                            <div class="">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="body">
                                            <form id="basic-form addForm" class="addForm" action="" method="POST"
                                                enctype="multipart/form-data" novalidate>

                                                <div class="form-group d-flex justify-content-between">

                                                    <div class="col-lg-6 col-md-12 pl-0">
                                                        <label>Chọn Danh mục</label>
                                                        <div class="c_multiselect">
                                                            <select id="single-selection" name="category_id"
                                                                class="categorySingleSelection multiselect multiselect-custom"
                                                                style="display: none;">
                                                                <?php
                                                                $categoriesArr = json_decode($categories, true);
                                                                if (!empty($categoriesArr)) {
                                                                    foreach ($categoriesArr as $item) {
                                                                        echo '<option value="' . $item['id'] . '">' . $item['name'] . '</option>';
                                                                    }
                                                                }
                                                                ?>
                                                            </select>
                                                            <div class="btn-group">
                                                                <button type="button"
                                                                    class="multiselect dropdown-toggle btn btn-default"
                                                                    data-toggle="dropdown" title="Chọn Danh mục">
                                                                    <span
                                                                        class="multiselect-selected-text categoryMultiselectSelectedText">
                                                                        --- Danh mục ---
                                                                    </span>
                                                                    <b class="caret"></b>
                                                                </button>
                                                                <ul class="multiselect-container categoryMultiselectContainer dropdown-menu"
                                                                    style="max-height: 300px; overflow: hidden auto;">
                                                                    <?php
                                                                    if (!empty($categoriesArr)) {
                                                                        foreach ($categoriesArr as $item) {
                                                                            echo '
                                                                                <li class="">
                                                                                    <a tabindex="0">
                                                                                        <label class="radio">
                                                                                            <input type="radio" value="' . $item['id'] . '"> ' . $item['name'] . '
                                                                                        </label>
                                                                                    </a>
                                                                                </li>';
                                                                        }
                                                                    }
                                                                    ?>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <script>
                                                        
                                                    </script>

                                                    <div class="col-lg-6 col-md-12 pr-0">
                                                        <label>Chọn Thương hiệu</label>
                                                        <div class="c_multiselect">
                                                            <select id="single-selection" name="brand_id"
                                                                class="brandSingleSelection multiselect multiselect-custom"
                                                                style="display: none;">
                                                                <?php
                                                                $brandsArr = json_decode($brands, true);
                                                                if (!empty($brandsArr)) {
                                                                    foreach ($brandsArr as $item) {
                                                                        echo '<option value="' . $item['id'] . '">' . $item['name'] . '</option>';
                                                                    }
                                                                }
                                                                ?>
                                                            </select>
                                                            <div class="btn-group">
                                                                <button type="button"
                                                                    class="multiselect dropdown-toggle btn btn-default"
                                                                    data-toggle="dropdown" title="Chọn Thương hiệu">
                                                                    <span
                                                                        class="brandMultiselectSelectedText multiselect-selected-text">
                                                                        --- Thương hiệu ---
                                                                    </span>
                                                                    <b class="caret"></b>
                                                                </button>
                                                                <ul class="brandMultiselectContainer multiselect-container dropdown-menu"
                                                                    style="max-height: 300px; overflow: hidden auto;">
                                                                    <?php
                                                                    if (!empty($brandsArr)) {
                                                                        foreach ($brandsArr as $item) {
                                                                            echo '
                                                                                <li class="">
                                                                                    <a tabindex="0">
                                                                                        <label class="radio">
                                                                                            <input type="radio" value="' . $item['id'] . '"> ' . $item['name'] . '
                                                                                        </label>
                                                                                    </a>
                                                                                </li>';
                                                                        }
                                                                    }
                                                                    ?>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <script>
                                                        
                                                    </script>

                                                </div>

                                                
                                                <div class="form-group">
                                                    <label>Tên Sản phẩm</label>
                                                    <input type="text" class="form-control" name="name" required>
                                                </div>

                                                <div class="form-group">
                                                    <label>Hình ảnh</label>
                                                    <input type="file" class="form-control" name="image"
                                                        id="fileInputImage" onclick="handleSingleImagePost(event)"/>
                                                </div>

                                                <div class="form-group">
                                                    <label>Album ảnh</label>
                                                    <input type="file" multiple class="form-control" name="album"
                                                        id="fileInputAlbum" onclick="handleAlbumImagePost(event)" />
                                                </div>

                                                <div class="form-group d-flex justify-content-between mb-0">
                                                    <div class="form-group col-6 pl-0">
                                                        <label>Giá</label>
                                                        <input type="text" class="form-control" name="price" required>
                                                    </div>

                                                    <div class="form-group col-6 pr-0">
                                                        <label>Giá giảm</label>
                                                        <input type="text" class="form-control" name="discount"
                                                            required>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label>Keyword</label>
                                                    <input type="text" class="form-control" name="keyword" required>
                                                </div>

                                                <div class="form-group">
                                                    <label>Description</label>
                                                    <textarea class="form-control" rows="5" cols="30" name="description"
                                                        required></textarea>
                                                </div>

                                                <div class="form-group d-flex justify-content-between text-center">

                                                    <div class="form-group">
                                                        <label>Trạng thái</label>
                                                        <br />
                                                        <label class="fancy-radio">
                                                            <input type="radio" name="hidden" value="0" required
                                                                data-parsley-errors-container="#error-radio">
                                                            <span><i></i>Ẩn</span>
                                                        </label>
                                                        <label class="fancy-radio">
                                                            <input type="radio" name="hidden" value="1">
                                                            <span><i></i>Hiện</span>
                                                        </label>
                                                        <p id="error-radio"></p>
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Xu hướng</label>
                                                        <br />
                                                        <label class="fancy-radio">
                                                            <input type="radio" name="strending" value="0" required
                                                                data-parsley-errors-container="#error-radio">
                                                            <span><i></i>Ẩn</span>
                                                        </label>
                                                        <label class="fancy-radio">
                                                            <input type="radio" name="strending" value="1">
                                                            <span><i></i>Hiện</span>
                                                        </label>
                                                        <p id="error-radio"></p>
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Nổi bật</label>
                                                        <br />
                                                        <label class="fancy-radio">
                                                            <input type="radio" name="feature" value="0" required
                                                                data-parsley-errors-container="#error-radio">
                                                            <span><i></i>Ẩn</span>
                                                        </label>
                                                        <label class="fancy-radio">
                                                            <input type="radio" name="feature" value="1">
                                                            <span><i></i>Hiện</span>
                                                        </label>
                                                        <p id="error-radio"></p>
                                                    </div>

                                                </div>

                                                <!-- <br> -->
                                                <div class="modal-footer">
                                                    <input type="submit" class="btn btn-primary" name="create"
                                                        value="Tạo Sản Phẩm"></input>
                                                    <button type="button" class="btn btn-danger"
                                                        data-dismiss="modal">Hủy</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- LargeSize -->
        <div class="modal fade" id="editModal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="title" id="editModalLabel">Cập nhật</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row clearfix">
                            <div class="row clearfix">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="body">
                                            <form id="basic-form" action="#" method="POST" enctype="multipart/form-data"
                                                novalidate>
                                                <div class="form-group">
                                                    <label>Tên Sản Phẩm</label>
                                                    <input type="text" class="form-control" placeholder="${item.name}"
                                                        required>
                                                </div>

                                                <div class="col-lg-12 col-md-12 px-0">
                                                    <div class="card">
                                                        <div class="header">
                                                            <h2>Icon <small> Sản Phẩm</small>
                                                            </h2>
                                                            <img src="<?= PUBLIC_URL ?>ct_shop/uploads/products/images/${item.image}" alt="">
                                                        </div>
                                                        <div class="body">
                                                            <input type="file" class="dropify">
                                                        </div>
                                                    </div>
                                                    <div class="card">
                                                        <!-- <div class="header">
                                                            <h2>With event and default file <small>try to remove the
                                                                    image</small></h2>
                                                        </div> -->
                                                        <div class="body">
                                                            <input type="file" id="dropify-event"
                                                                data-default-file="<?= PUBLIC_URL ?>ct_shop/uploads/products/images/${item.image}">
                                                        </div>
                                                    </div>
                                                    <div class="card">
                                                        <div class="header">
                                                            <h2>Disabled file upload</h2>
                                                        </div>
                                                        <div class="body">
                                                            <input type="file" class="dropify" disabled="disabled">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label>Keyword</label>
                                                    <input type="email" class="form-control" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Description</label>
                                                    <textarea class="form-control" rows="5" cols="30"
                                                        required></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label>Trạng thái</label>
                                                    <br />
                                                    <label class="fancy-radio">
                                                        <input type="radio" name="gender" value="male" required
                                                            data-parsley-errors-container="#error-radio">
                                                        <span><i></i>Ẩn</span>
                                                    </label>
                                                    <label class="fancy-radio">
                                                        <input type="radio" name="gender" value="female">
                                                        <span><i></i>Hiện</span>
                                                    </label>
                                                    <p id="error-radio"></p>
                                                </div>

                                                <!-- <br> -->
                                                <div class="modal-footer">

                                                    <input type="submit" class="btn btn-primary"
                                                        value="Lưu thay đổi"></input>
                                                    <button type="button" class="btn btn-danger"
                                                        data-dismiss="modal">Hủy</button>

                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <script src="<?= PUBLIC_URL ?>dashboard/js/handleEvent/modalFade.js"></script>
        <script src="<?= PUBLIC_URL ?>dashboard/js/handleEvent/handleImage.js"></script>