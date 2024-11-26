<?php
require_once __DIR__ . '/../Classes/init.php';

$category = new Category();

$categories = $category->all();

?>
<div class="container-fluid">
    <!-- ========== title-wrapper start ========== -->
    <div class="title-wrapper pt-30">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="title">
                    <h2>Create Post</h2>
                </div>
            </div>
            <!-- end col -->
            <div class="col-md-6">
                <div class="breadcrumb-wrapper">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="#0">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Create Post
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <!-- ========== title-wrapper end ========== -->
    <div class="form-editor-wrapper">
        <div class="row">
            <div class="col-12">
                <div class="card-style mb-30">
                    <form action="" id="editor-form" method="post">
                        <div class="input-style-1">
                            <h6 class="mb-10">Judul Artikel</h6>
                            <input type="text" placeholder="Judul Artikel" name="title" />
                        </div>
                        <div class="input-style-1">
                            <h6 class="mb-10">Gambar Artikel</h6>
                            <input class="form-control" type="file" name="post_img" id="postImage" accept="image/*">
                        </div>
                        <div class="select-style-1">
                            <h6 class="mb-10">Kategori Artikel</h6>
                            <div class="select-position">
                                <select class="light-bg" name="id_category">
                                    <option value="">Pilih Kategori</option>
                                    <?php foreach ($categories as $category) : ?>
                                        <option value="<?= $category['category_id']; ?>"><?= $category['name_category']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="title d-flex justify-content-between align-items-center">
                            <h6 class="mb-30">Tulis Artikel</h6>
                        </div>
                        <div id="quill-toolbar">
                            <span class="ql-formats">
                                <select class="ql-font"></select>
                                <select class="ql-size"></select>
                            </span>
                            <span class="ql-formats">
                                <button class="ql-bold"></button>
                                <button class="ql-italic"></button>
                                <button class="ql-underline"></button>
                                <button class="ql-strike"></button>
                            </span>
                            <span class="ql-formats">
                                <select class="ql-color"></select>
                                <select class="ql-background"></select>
                            </span>
                            <span class="ql-formats">
                                <button class="ql-script" value="sub"></button>
                                <button class="ql-script" value="super"></button>
                            </span>
                            <span class="ql-formats">
                                <button class="ql-header" value="1"></button>
                                <button class="ql-header" value="2"></button>
                                <button class="ql-blockquote"></button>
                                <button class="ql-code-block"></button>
                            </span>
                            <span class="ql-formats">
                                <button class="ql-list" value="ordered"></button>
                                <button class="ql-list" value="bullet"></button>
                                <button class="ql-indent" value="-1"></button>
                                <button class="ql-indent" value="+1"></button>
                            </span>
                            <span class="ql-formats">
                                <button class="ql-direction" value="rtl"></button>
                                <select class="ql-align"></select>
                            </span>
                            <span class="ql-formats">
                                <button class="ql-link"></button>
                                <button class="ql-image"></button>
                            </span>
                            <span class="ql-formats">
                                <button class="ql-clean"></button>
                            </span>
                        </div>
                        <div id="quill-editor"></div>
                        <input type="hidden" name="content" id="content">
                        <div class="d-flex justify-content-end mt-30 gap-3">
                            <a href="index-post.php" class="main-btn light-btn btn-hover">Gak Jadi</a>
                            <button type="submit" name="submit" class="main-btn primary-btn btn-hover " name="submit">Create Post</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- end row -->
    </div>
    <!-- ========== form-editor-wrapper end ========== -->
</div>
<script src="./../assets/js/jquery-3.7.1.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const editor = new Quill("#quill-editor", {
            modules: {
                toolbar: "#quill-toolbar",
            },
            placeholder: "Type something",
            theme: "snow",
        });

        $("#editor-form").on("submit", function(e) {
            const content = editor.root.innerHTML;
            $("#content").val(content);
            e.preventDefault();
        });
    });
</script>