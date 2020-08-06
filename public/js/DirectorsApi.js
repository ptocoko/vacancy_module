let newVcButton = $('#new_vacancy');
let newVcModal = $('#new_vacancy_modal');
let newVcModalFon = $('#new_vacancy_fon');
let vacaArrray = [];

function modalCenter() {
    let blockCenter = [$('.modal').height() / 2, $('.modal').width() / 2];
    let contCenter = [$('#circle').height() / 2, ($('#circle').width() / 2)];
    let top = blockCenter[0] - contCenter[0];
    let left = blockCenter[1] - contCenter[1];
    $('#circle').css('top', top).css('left', left).css('visibility', 'visible');
}

newVcButton.on('click', function (e) {
    e.preventDefault();
    newVcModal.html(newVacaModal()).after(function () {
        setModalValues();
        setModalHandlers();
    });
    newVcModalFon.addClass('active');
    newVcModal.addClass('active');
    $('body').css('overflow', 'hidden');
});

function setModalValues() {
    $('#staj').styler({
        onFormStyled: function () {
            $('.jq-selectbox__dropdown ul').scrollbar();
        }
    });
    getDoljnosti()
        .then(res => {
            res.map(function (value) {
                $('#base_dolj').append(value.typedoljnostid !== '1' ?
                    `<option id="dolj${value.id}" value="${value.id}">${value.name}</option>` :
                    `<option id="dolj${value.id}" value="${value.id}">Учитель ${value.name}</option>`
                );
            });
            $('#base_dolj').styler({
                onFormStyled: function () {
                    $('.jq-selectbox__dropdown ul').scrollbar();
                }
            });
        });
    $(`#salary`).ionRangeSlider({
        type: "single",
        skin: "round",
        prettify_enabled: true,
        step: 100,
        min: 0,
        max: 100000,
        postfix: " &#8381;",
    });
    $(`#salary_check`).prop('checked', true);
}

function modalClosing() {
    newVcModalFon.removeClass("active");
    newVcModal.removeClass("active");
    $('body').css('overflow', 'auto');
    setTimeout(() => newVcModal.html(''), 500);
}

function check(pid, staid) {
    if (pid === '0') {
        $('#error_no_dolj').slideToggle();
        setTimeout(function () {
            $('#error_no_dolj').slideToggle();
        }, 1500);
        return false;
    }
    if (staid === '0') {
        $('#error_no_staj').slideToggle();
        setTimeout(function () {
            $('#error_no_staj').slideToggle();
        }, 1500);
        return false;
    }
    return true;
}

function okModal(text) {
    return `<div id="circle" style="position: fixed; visibility: hidden">
                    <svg class="checkmark" viewBox="0 0 52 52" xmlns="http://www.w3.org/2000/svg">
                        <circle class="checkmark__circle" cx="26" cy="26" fill="none" r="25"/>
                        <path class="checkmark__check" d="M14.1 27.2l7.1 7.2 16.7-16.8" fill="none"/>
                    </svg>
                    <p class="mb-0 small font-weight-medium text-uppercase mb-1 text-muted lts-2px" style="color: #7ac142;">${text}</p>
	            </div>`;
}

function badModal(info) {
    return `<div id="circle" style="position: fixed; visibility: hidden">
                    <svg class="checkmark__x" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
                      <circle class="checkmark__circle__x" cx="26" cy="26" r="25" fill="none" />
                      <path class="checkmark__check__x" fill="none" d="M16 16 36 36 M36 16 16 36" />
                    </svg>
                    <p class="mb-0 small font-weight-medium text-uppercase mb-1 text-muted lts-2px" style="color: #d70707;">${info}</p>
                </div>`;
}

function setModalHandlers() {
    const salaryElem = $(`#salary`);
    let salary = salaryElem.prop("value");
    const sliderElemInstance = salaryElem.data('ionRangeSlider');
    salaryElem.on('change', (e) => {
        if (e.target.value == 0) {
            salary = 'no'
        } else {
            salary = e.target.value
        }
    });
    $(`#salary_check`).on('change', (e) => {
        const disable = !e.target.checked;
        sliderElemInstance.update({
            from: 0,
            disable: disable
        })
    });
    $(`#close_modal`).on('click', () => modalClosing());
    $(`#post`).on('click', (e) => {
        e.preventDefault();
        const staj = $('#staj').val();
        const dopInfo = $('#dopinfo').val();
        const pid = $('#base_dolj').val();
        if (check(pid, staj)) {
            $.ajax({
                type: "POST",
                url: `${baseUrl}/vacancies/`,
                data: {
                    'payment': salary,
                    'pid': pid,
                    'staid': staj,
                    'dopinfo': dopInfo
                }
            }).fail((jqXHR, textStatus) => {
                $('.modal-content').html(badModal(`Ошибка ${jqXHR.status} ${jqXHR.responseText}`)).after(() => modalCenter());
                setTimeout(() => modalClosing(), 1300);
            }).done((res) => {
                $('.modal-content').html(okModal("Вакансия успешно сохранена")).after(() => modalCenter());
                setTimeout(() => modalClosing(), 1300);
                const vacancy = new DirectorVacancy(res.date_insert, res.doljnost_id, res.dop_info, res.dtype, res.id, res.id_directora, res.name, res.schoolid, res.staj_id, res.value, res.zp, res.resp);
                vacancy.renderDirectorSide(`#schools_vacancies`)
            });
        }
    });
}

function newVacaModal() {
    return `<a class="close-modal" id="close_modal">
					<svg viewBox="0 0 20 20">
						<path d="M15.898,4.045c-0.271-0.272-0.713-0.272-0.986,0l-4.71,4.711L5.493,4.045c-0.272-0.272-0.714-0.272-0.986,0s-0.272,0.714,0,0.986l4.709,4.711l-4.71,4.711c-0.272,0.271-0.272,0.713,0,0.986c0.136,0.136,0.314,0.203,0.492,0.203c0.179,0,0.357-0.067,0.493-0.203l4.711-4.711l4.71,4.711c0.137,0.136,0.314,0.203,0.494,0.203c0.178,0,0.355-0.067,0.492-0.203c0.273-0.273,0.273-0.715,0-0.986l-4.711-4.711l4.711-4.711C16.172,4.759,16.172,4.317,15.898,4.045z"
						      fill="#000000"></path>
					</svg>
				</a><!-- close modal -->
				<div class="modal-content" style="width:100%;">
					<div class="my-2 p-relative bg-white px-2 py-2"
					     style="width: 100%; overflow: hidden; border-radius: 1px;">
						<p class="mb-0 small font-weight-medium text-uppercase mb-1 text-black lts-2px">
							${new Date().toLocaleDateString()}
						</p>
						<h1 class="ff-serif font-weight-normal text-black card-heading mt-0 mb-1"
						    style="line-height: 1.25;">
							<select id="base_dolj">
								<option id="dolj0" value="0">Выберите должность</option>
							</select>
							<label class="checkbox my-1">
								<input checked id="salary_check" type="checkbox"><span></span>Указать
								размер заработной платы
							</label>
							<input id="salary" placeholder="Размер зарабатной платы в рублях" type="text">
						</h1>
						<select id="staj">
							<option value="0">Выберите стаж работы</option>
							<option value="1">Начало карьеры, выпускник</option>
							<option value="2">1-3 лет</option>
							<option value="3">3-5 лет</option>
							<option value="4">Свыше 5 лет</option>
						</select>
						<p class="mb-1"><b>Дополнительная информация</b>:</p>
						<textarea id="dopinfo"
						          maxlength="1050"
						          class="mb-1"
						          placeholder="Укажите дополнительную информацию"></textarea>
						</p>
						<p class="small font-weight-medium text-uppercase lts-2px red my-1"
						   id="error_no_dolj"
						   style="display:none;">
							Выберите должность
						</p>
						<p class="small font-weight-medium text-uppercase lts-2px red my-1"
						   id="error_no_staj"
						   style="display:none;">
							Выберите необходимый стаж
						</p>
						<a class="text-uppercase d-block font-weight-medium lts-2px text-center styled-link exit__btn"
						    
						   id="post">
						   Добавить вакансию
						</a>
					</div>
				</div>`
}

function renderVaca() {
    DirectorVacancy.respslength = 0;
    getVacanciesBySchoolId().then(result => {
        $('.rating-box').html('');
        result.map(function (res) {
            const vacancy = new DirectorVacancy(res.date_insert, res.doljnost_id, res.dop_info, res.dtype, res.id, res.id_directora, res.name, res.schoolid, res.staj_id, res.value, res.zp, res.resp);
            vacancy.renderDirectorSide(`#schools_vacancies`)
        });
        $('#vacancy_count').text(getRightSting(DirectorVacancy.respslength));
    })
}

function getRightSting(length) {
    if (length == 1) {
        return `${length} соискатель`
    }
    if (length == 2 || length == 3 || length == 4) {
        return `${length} соискателя`
    }
    if (length > 5) {
        return `${length} соискателя`
    }
    return '0';
}

$(document).ready(() => {
    renderVaca();
});

