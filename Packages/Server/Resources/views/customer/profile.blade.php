<div class="modal-dialog">
    <button type="button" class="close d-none" data-dismiss="modal" aria-hidden="true"></button>
    <div class="modal-content">
        <div class="modal-header flex-row-reverse ">
            <h4 class="modal-title">
                <div style="float:right">Thông tin về:</div><br>
                <div class="modal-name">Joe</div>
            </h4>
        </div>
        <div class="modal-body">
            <div class="d-flex justify-content-center flex-column align-items-center">
                <img src="{{ asset('DoAnTotNghiep/server/assets/images/admin_default.png') }}" width="140" height="140"
                     class="img-circle"></a>
                <h3 class="media-heading modal-name">
                    <div class="modal-name">Joe Sixpack</div>
                    (<small class="modal-id">ID: 1</small>)
                </h3>
            </div>
            <hr>
            <div class="col-md-12 col-xl-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <ul class="nav nav-tabs" id="detail-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="profile-tab" data-toggle="tab" data-target="#profile"
                                        type="button" role="tab" aria-controls="profile" aria-selected="true">Profile
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="contact-tab" data-toggle="tab" data-target="#contact"
                                        type="button" role="tab" aria-controls="contact" aria-selected="false">Contact
                                </button>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <div class="media">
                                    <div class="media-body">
                                        <h4 class="mt-0 d-flex justify-content-between">
                                            <div class="fw-bold">Tên người dùng:</div>
                                            <div class="modal-name">John Doe</div>
                                        </h4>
                                        <p class="modal-description">Mô tả</p>
                                        <div class="d-flex justify-content-between">
                                            <div class="fw-bold">Address:</div>
                                            <div class="modal-address">Bac Tu Liem, Ha Noi</div>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <div class="fw-bold">Thời gian tạo</div>
                                            <div class="modal-c_at">20-10-2022</div>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <div class="fw-bold">Thời gian cập nhật</div>
                                            <div class="modal-u_at">20-10-2022</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                                <h2>
                                    Thông tin liên lạc:
                                </h2>
                                <div class="contac-info">
                                    <p>
                                        <i class="ti-headphone-alt text-info padding-r-15"></i>
                                        <label for="Phone Number" style="font-size: 16px">Số điện thoại: </label><span class="modal-phone-number pl-1">+123456789</span>
                                    </p>
                                    <p>
                                        <i class="ti-email text-success padding-r-15"></i>
                                        <label for="Email" style="font-size: 16px">Địa chỉ email </label><span class="modal-email pl-1">email@email.com</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <button type="button" class="btn btn-default" style="text-align:right" data-dismiss="modal">Trở lại trang.</button>
    </div>
</div>
</div>
