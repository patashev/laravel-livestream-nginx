<div class="form-footer">
    <?php if(isset($submit) == false || $submit == true): ?>
        <button class="btn btn-labeled btn-primary btn-submit">
            <span class="btn-label"><i class="fa fa-fw fa-save"></i></span>Submit
        </button>
    <?php endif; ?>

    <a onclick="GoBackWithRefresh()" class="btn btn-labeled btn-default">
        <span class="btn-label"><i class="fa fa-fw fa-chevron-left"></i></span>Back
    </a>
</div>

<script type="text/javascript">
function GoBackWithRefresh(event) {
    if ('referrer' in document) {
        window.location = document.referrer;
        /* OR */
        //location.replace(document.referrer);
    } else {
        window.history.back();
    }
}
</script>
