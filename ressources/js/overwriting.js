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

        $deleteAdminForm.find('select').change(function() {
            var adminId = $(this).val();
            $deleteAdminForm.attr('action', 'manager/delete/'+adminId);
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

    $('form').submit(function() {
        if ($(this).data('confirmSuppr')) {
            return confirm('Attention, la suppression est définitive. Êtes vous sûr de vouloir continuer ?');
        }
    });

    // var $infosForm = $('#infosForm');
    //
    // if ($infosForm.length) {
    //
    //     $infosForm.find('a').click(function(e) {
    //         e.preventDefault();
    //
    //     });
    // }

});
