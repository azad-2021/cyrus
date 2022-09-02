function select_search(search,option,messageNoResult='No Result') {
    //check if element don't exist in dom
    if ( option.length==0){
        return;
    }

    /*hide option don't contain search in input*/
    var firstItemSelected=0;
    $(option).each(function () {
        //check if option is #optionSearchNoResult
        if ($(this).attr('id') == 'optionSearchNoResult') {
            $(this).remove();
        }else {
            var result=$(this).text().search(search);
            if (result == -1 ){
                $(this).removeAttr('selected').hide();
            }else {
                $(this).show();
                if (firstItemSelected == 0){
                    firstItemSelected = 1;
                    $(this).attr('selected','true');
                }
            }
        }
    });
    if (firstItemSelected == 0){
        option.parent().append(
            "<option id='optionSearchNoResult' selected>"+messageNoResult+"</option>"
        );
    }
}