(function ($) {
    $(document).ready(function(){

        //Closing Mobile menu when clicking on title

        var API = $("#mmenu").data( "mmenu" );
        $(".mm-navbar__title").click(function() {
            API.close();
        });
        //Changing icon on mobile menu open/close
        $('#searchform .far').click(function(){
            $('.search-input').slideToggle();
            $(this).toggleClass('fa-search fa-times');
        })

        //Converting dropdown to hover for menus
        $(".dropdown, .btn-group").hover(function(){
            var dropdownMenu = $(this).children(".dropdown-menu");
            if(dropdownMenu.is(":visible")){
                dropdownMenu.parent().toggleClass("open");
            }
        });
        var tallness = $("#masthead").height();
        $(".header-space").height(tallness);

        //Adding data attributes to submit issue button on admin bar
        $('.submit-issue-btn a').attr("data-toggle","modal").attr("data-target",".issue-modal");
        $('.cu-form-wrap').after('<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>');

    });
})( jQuery );
