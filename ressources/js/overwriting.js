$(function(){

    // AFFICHAGE DES DIFFERENTS LOGOS SELON LA NAVBAR (STICKY OU ORIGINAL)

    var navbar = $('nav.rd-navbar--is-clone');
    var logoSmall = navbar.find('#logo-small');
    var logoText = navbar.find('#logo-text');

    logoSmall.hide();
    logoText.show();


    // SELECTION D'UN ADMIN A SUPPRIMER (ROUTE DYNAMIQUE )

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

    // SELECT Récuperation BACKUP

    var $loadBackupForm = $('#load-backup');

    if ($loadBackupForm.length) {
        var $loadFormBtn = $loadBackupForm.find('.btn');
        var $loadFormPass = $loadBackupForm.find('[name="password"]');

        $loadBackupForm.find('select').change(function() {
            var loadId = $(this).val();
            if(loadId == 0) {
                $loadFormBtn.addClass('disabled');
                $loadFormBtn.attr('disabled', 'disabled');
                $loadFormPass.slideUp();
            } else {
                $loadFormBtn.removeClass('disabled');
                $loadFormBtn.removeAttr('disabled');
                $loadFormPass.slideDown();
            }
        });
    }


    // CONFIRMATION POUR LES FORMULAIRES QUI GERENT UNE SUPPRESSION EN BDD

    $('form').submit(function() {
        if ($(this).data('confirmSuppr')) {
            return confirm('Attention, cette action est définitive. Êtes vous sûr de vouloir continuer ?');
        }
    });

    // INFOS PUBLIQUES, FORMULAIRES D'AJOUT ADRESSE ET TEL FACULTATIFS

    var $infosForm = $('#infosForm');

    if ($infosForm.length) {
        var $adress1 = $infosForm.find('#fieldAdress1');
        var $tel1 = $infosForm.find('#fieldTel1');
        var $moreInfosLinks = $infosForm.find('a');

        var $adress2 = $('  <div class="well" id="fieldAdress2" style="display:none;">\
                                    <h3 class="well-bottom">Adresse 2 (facultatif)</h3>\
                                    <label for="adress2">N° et rue</label>\
                                    <input type="text" class="form-control" name="adress2" data-constraints="@NotEmpty">\
                                    <label for="complt_adress2">Complément d\'adresse (facultatif)</label>\
                                    <input type="text" class="form-control" name="complt_adress2">\
                                    <label for="cp2">Code postal</label>\
                                    <input type="text" class="form-control" name="cp2" data-constraints="@NotEmpty">\
                                    <label for="city2">Ville</label>\
                                    <input type="text" class="form-control" name="city2" data-constraints="@NotEmpty">\
                                    <p class="well"><a href="#" data-target="adress2"><i class="fa fa-times-circle" aria-hidden="true"></i> Supprimer cette adresse</a></p>\
                                </div>');
        var $tel2 = $('<div class="well" id="fieldTel2" style="display:none;">\
                                <h3 class="well-bottom">Téléphone 2 (facultatif)</h3>\
                                <label for="tel2">N°</label>\
                                <input type="text" class="form-control" name="tel2" data-constraints="@NotEmpty">\
                                <p class="well"><a href="#" data-target="tel2"><i class="fa fa-times-circle" aria-hidden="true"></i> Supprimer ce numéro de téléphone</a></p>\
                            </div>');

        $infosForm.on('click', 'a', function(e) {
            e.preventDefault();
            var target = $(this).data('target');
            var $parent = $(this).parent();

            if ($(this).data('show')) {

                $parent.hide();

                switch (target) {
                    case 'adress2':
                        $parent.after($adress2.show());
                        break;
                    case 'tel2':
                        $parent.after($tel2.show());
                        break;
                }

            }
            else {
                $parent.parent().remove();

                switch (target) {
                    case 'adress2':
                        $adress1.next().show();
                        break;
                    case 'tel2':
                        $tel1.next().show();
                        break;
                }
            }

        });
    }


    var $contactForm = $('.rd-mailform');
    if ($contactForm.length) {
        var $select = $contactForm.find('select');
        var $subject = $contactForm.find('input[name=subject]');
        $select.change(function(){
            if ( $(this).val() == 'contact' ) {
                $subject.attr('placeholder', 'Objet de la demande');
            } else {
                $subject.attr('placeholder', 'Date et type de l\'évènement');
            }
        });
    }

    //GESTION DE LA PAGINATION DE LA GALLERIE PHOTO EN AJAX
    function getResult(url){
      $.ajax({
        url: url,
        type: "GET",
        data: {page: $("#gallery a.btn").attr('id')},
        success: function(data){
          $("#galleryImg").html(data);
          console.log('success');
        }
      });
    }

    $("#gallery a.pagination").click(function(e){
      e.preventDefault();
      var url = $(this).attr('id');
      getResult(url);
    });





});
