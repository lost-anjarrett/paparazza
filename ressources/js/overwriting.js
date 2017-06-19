$(function(){

    var navbar = $('nav.rd-navbar--is-clone');
    var logoSmall = navbar.find('#logo-small');
    var logoText = navbar.find('#logo-text');

    logoSmall.hide();
    logoText.show();

    var $deleteAdminForm = $('#delete-admin');

    if ($deleteAdminForm.length) {
        var $adminFormBtn = $deleteAdminForm.find('.btn');
        var $adminFormPass = $deleteAdminForm.find('[name="password"]');
        var loggedAdmin = $deleteAdminForm.data('loggedId');
        console.log('data-id : '+ loggedAdmin);
        console.log($deleteAdminForm.data());


        $deleteAdminForm.find('select').change(function() {
            var adminId = $(this).val();
            $deleteAdminForm.attr('action', 'manager/delete/'+adminId);
            console.log($deleteAdminForm.attr('action'));
            if(adminId == 0 || adminId == loggedAdmin) {
                $adminFormBtn.addClass('disabled');
                $adminFormBtn.attr('disabled', 'disabled');
                $adminFormPass.slideUp();
            } else {
                $adminFormBtn.removeClass('disabled');
                $adminFormBtn.removeAttr('disabled');
                $adminFormPass.slideDown();
            }
        });
    }

});
