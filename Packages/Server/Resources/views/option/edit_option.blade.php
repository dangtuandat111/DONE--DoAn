<div class="confirm-popup">
    <!-- Modal -->
    <div class="modal fade" id="edit-option" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header justify-content-center">
                    <h5 class="modal-title f-20px">Cập nhật tùy chọn</h5>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="optionName">Tên tùy chọn</label>
                        <input type="text" class="form-control" id="optionName" placeholder="Tên tùy chọn">
                    </div>
                    <div class="form-group">
                        <label for="optionValue">Giá trị tùy chọn</label>
                        <input type="number" class="form-control" id="optionValue" placeholder="Giá trị tùy chọn">
                    </div>
                    <div class="form-group">
                        <label for="optionBonusCost">Giá thêm</label>
                        <input type="number" class="form-control" id="optionBonusCost" placeholder="Giá thêm">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy bỏ</button>
                    <button type="button" class="btn btn-primary confirm-save" data-id="-1" data-name="-1" data-value="-1" data-bonus="-1">Cập nhật</button>
                </div>
            </div>
        </div>
    </div>
</div>
