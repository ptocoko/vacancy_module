class VacancyController {
    vacancyArray = [];
    counter = 0;
    baseId = `#page_${this.counter}`;
    modalBolck;
    modalFon;

    set vacancyArray(value) {
        this.vacancyArray = value;
    }

    renderVacancies() {
        if ('#' + $('#vaca_cards').children().attr('id') != this.baseId) {
            $('#vaca_cards').append(`<div class="base-cards my-2 mx-1"  id="page_${this.counter}"></div>`)
        }
        $('#page_' + this.counter).html('');
        this.vacancyArray[this.counter].map(value => {
            let block = $("<div class='my-2 p-relative mx-auto'></div>");
            value.renderVacancyTeacherSide(block, this.baseId, this.modalBolck, this.modalFon);
        });
        this.vacancyArray[this.counter] = [];
    }
}
