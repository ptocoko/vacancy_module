class DirectorVacancy {
    date;
    doljnost;
    dopInfo;
    typeDoljnost;
    id;
    idDirector;
    name;
    schoolid;
    stajId;
    stajValue;
    zp;
    resps;
    vacancyModal = $('#new_vacancy_modal');
    vacancyModalFon = $('#new_vacancy_fon');

    constructor(date, doljnost, dopInfo, typeDoljnost, id, idDirector, name, schoolid, stajId, stajValue, zp, resps) {
        this.date = date;
        this.doljnost = doljnost;
        this.dopInfo = dopInfo;
        this.typeDoljnost = typeDoljnost;
        this.id = id;
        this.idDirector = idDirector;
        this.name = name;
        this.schoolid = schoolid;
        this.stajId = stajId;
        this.stajValue = stajValue;
        this.zp = zp;
        this.resps = resps;
    }

    getDoljnost = () => this.typeDoljnost === '1' ? `Учитель ${this.name}` : `${this.name}`;
    getCardMarkUp = () => {
        return `
					<div class="accordion-name" id="name_${this.id}" style=" display: flex;align-items: center;padding: 5px 5px 5px 50px;justify-content: space-between;">
						<p class="small font-weight-normal text-uppercase lts-2px" id="p_${this.id}"
						   style="cursor: pointer;">${this.date} ${this.getDoljnost()} откликнулись: <b id="resps_${this.id}">${this.resps.length}</b>
						</p>
						<div>
							<a class="text-uppercase btn--light  d-inline-block font-weight-medium lts-2px styled-link exit__btn"
							       id="edit_${this.id}"><i aria-hidden="true" class="fa fa-pencil"></i></a>
							<a class="text-uppercase btn--light  d-inline-block font-weight-medium lts-2px styled-link cancel__btn"
							       id="delete_${this.id}"><i aria-hidden="true" class="fa fa-trash"></i></a>						
						</div>
					</div>
					<div class="accordion-content mx-2 pb-1">
						<ul>${this.resps.map((resp) => {
            return `<li id="li_${resp.response_id}"><p class="mb-0 small font-weight-normal text-uppercase mb-1 text-black lts-2px">
										<b>${resp.response_day}</b> Отклик от ${resp.surname} ${resp.name} ${resp.secondname}  
										<a class="styled-link" id="resp_${resp.response_id}" style="cursor: pointer;">Подробнее...</a>
									</p></li>`;
        }).join('')}
						</ul>
					</div>
				`
    };
    modalClosing = () => {
        this.vacancyModalFon.removeClass("active");
        this.vacancyModal.removeClass("active");
        $('body').css('overflow', 'auto');
        setTimeout(() => this.vacancyModal.html(''), 500);
    };
    getModalMarkUp = () => {
        return `<a class="close-modal" id="close_modal_${this.id}">
					<svg viewBox="0 0 20 20">
						<path d="M15.898,4.045c-0.271-0.272-0.713-0.272-0.986,0l-4.71,4.711L5.493,4.045c-0.272-0.272-0.714-0.272-0.986,0s-0.272,0.714,0,0.986l4.709,4.711l-4.71,4.711c-0.272,0.271-0.272,0.713,0,0.986c0.136,0.136,0.314,0.203,0.492,0.203c0.179,0,0.357-0.067,0.493-0.203l4.711-4.711l4.71,4.711c0.137,0.136,0.314,0.203,0.494,0.203c0.178,0,0.355-0.067,0.492-0.203c0.273-0.273,0.273-0.715,0-0.986l-4.711-4.711l4.711-4.711C16.172,4.759,16.172,4.317,15.898,4.045z"
						      fill="#000000"></path>
					</svg>
				</a><!-- close modal -->
				<div class="modal-content" style="width:100%;">
					<div class="my-2 p-relative bg-white px-2 py-2"
					     style="width: 100%; overflow: hidden; border-radius: 1px;">
						<p class="mb-0 small font-weight-medium text-uppercase mb-1 text-black lts-2px">
							${this.date}
						</p>
						<h1 class="ff-serif font-weight-normal text-black card-heading mt-0 mb-1"
						    style="line-height: 1.25;">
							<select id="base_dolj">
								<option id="dolj0" value="0">Выберите должность</option>
							</select>
							<label class="checkbox my-1">
								<input checked id="salary_check_${this.id}" type="checkbox"><span></span>Указать
								размер заработной платы
							</label>
							<input id="salary_${this.id}" placeholder="Размер зарабатной платы в рублях" type="text">
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
						   href="#"
						   id="update_${this.id}">
						   Сохранить изменения
						</a>
					</div>
				</div>`
    };

    okModal(text) {
        return `<div id="circle" style="position: fixed; visibility: hidden">
                    <svg class="checkmark" viewBox="0 0 52 52" xmlns="http://www.w3.org/2000/svg">
                        <circle class="checkmark__circle" cx="26" cy="26" fill="none" r="25"/>
                        <path class="checkmark__check" d="M14.1 27.2l7.1 7.2 16.7-16.8" fill="none"/>
                    </svg>
                    <p class="mb-0 small font-weight-medium text-uppercase mb-1 text-muted lts-2px" style="color: #7ac142;">${text}</p>
	            </div>`;
    };

    badModal(info) {
        return `<div id="circle" style="position: fixed; visibility: hidden">
                    <svg class="checkmark__x" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
                      <circle class="checkmark__circle__x" cx="26" cy="26" r="25" fill="none" />
                      <path class="checkmark__check__x" fill="none" d="M16 16 36 36 M36 16 16 36" />
                    </svg>
                    <p class="mb-0 small font-weight-medium text-uppercase mb-1 text-muted lts-2px" style="color: #d70707;">${info}</p>
                </div>`;
    };

    modalCenter() {
        let blockCenter = [this.vacancyModal.height() / 2, this.vacancyModal.width() / 2];
        let contCenter = [$('#circle').height() / 2, ($('#circle').width() / 2)];
        let top = blockCenter[0] - contCenter[0];
        let left = blockCenter[1] - contCenter[1];
        $('#circle').css('top', top).css('left', left).css('visibility', 'visible');
    };

    setModalValues = () => {
        $('#staj').val(this.stajId).styler({
            onFormStyled: function () {
                $('.jq-selectbox__dropdown ul').scrollbar();
            }
        });
        $('#dopinfo').val(this.dopInfo);
        getDoljnosti().then(res => {
            res.map(function (value) {
                $('#base_dolj').append(value.typedoljnostid !== '1' ?
                    `<option id="dolj${value.id}" value="${value.id}">${value.name}</option>` :
                    `<option id="dolj${value.id}" value="${value.id}">Учитель ${value.name}</option>`
                );
            });
            $('#base_dolj').val(this.doljnost).styler({
                onFormStyled: function () {
                    $('.jq-selectbox__dropdown ul').scrollbar();
                }
            });
        });
        $(`#salary_${this.id}`).ionRangeSlider({
            type: "single",
            skin: "round",
            prettify_enabled: true,
            step: 100,
            min: 0,
            max: 100000,
            from: this.zp,
            postfix: " &#8381;",
        });
        const sliderElemInstance = $(`#salary_${this.id}`).data('ionRangeSlider');
        if (this.zp === 'no') {
            $(`#salary_check_${this.id}`).prop('checked', false);
            sliderElemInstance.update({
                from: 0,
                disable: true
            })
        }
    };

    check(pid, staid) {
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

    hasBeenChanged = (staj, dopinfo, pid, paymentValue) => {
        let output = false;
        if (staj != this.stajId) {
            output = true;
        }
        if (dopinfo != this.dopInfo) {
            output = true;
        }
        if (pid != this.doljnost) {
            output = true;
        }
        if (paymentValue != this.zp) {
            output = true;
        }
        return output;
    };
    updateVacancy = (res) => {
        this.date = res.date_insert;
        this.doljnost = res.doljnost_id;
        this.dopInfo = res.dop_info;
        this.typeDoljnost = res.dtype;
        this.name = res.name;
        this.stajId = res.staj_id;
        this.stajValue = res.value;
        this.zp = res.zp;
        this.resps = res.resp;
    };
    setModalHandlers = () => {
        const salaryElem = $(`#salary_${this.id}`);
        let salary = salaryElem.prop("value");
        const sliderElemInstance = salaryElem.data('ionRangeSlider');
        salaryElem.on('change', (e) => {
            if (e.target.value == 0) {
                salary = 'no'
            } else {
                salary = e.target.value
            }
        });
        $(`#salary_check_${this.id}`).on('change', (e) => {
            const disable = !e.target.checked;
            sliderElemInstance.update({
                from: 0,
                disable: disable
            });
            salary = 'no';
        });
        $(`#close_modal_${this.id}`).on('click', () => this.modalClosing());
        $(`#update_${this.id}`).on('click', (e) => {
            e.preventDefault();
            const staj = $('#staj').val();
            const dopInfo = $('#dopinfo').val();
            const pid = $('#base_dolj').val();
            if (!this.resps.length) {
                if (this.hasBeenChanged(staj, dopInfo, pid, salary)) {
                    if (this.check(pid, staj)) {
                        $.ajax({
                            type: "PATCH",
                            url: `${baseUrl}/vacancies/`,
                            data: {
                                'id': this.id,
                                'payment': salary,
                                'pid': pid,
                                'staid': staj,
                                'dopinfo': dopInfo,
                                'schoolid': this.schoolid
                            }
                        }).fail(jqXHR => {
                            $('.modal-content').html(this.badModal(`Ошибка ${jqXHR.status} ${jqXHR.responseText}`)).after(() => this.modalCenter());
                            setTimeout(() => this.modalClosing(), 1300);
                        }).done((data) => {
                            this.updateVacancy(data);
                            $('.modal-content').html(this.okModal("Ваши изменения успешно сохранены")).after(() => this.modalCenter());
                            setTimeout(() => this.modalClosing(), 1300);
                            $(`#p_${this.id}`).html(`${this.date} ${this.getDoljnost()} откликнулись: <b>${this.resps.length}</b>`);
                        });
                    }
                } else {
                    $('.modal-content').html(this.okModal("Ваши изменения успешно сохранены")).after(() => this.modalCenter());
                    setTimeout(() => this.modalClosing(), 1300);
                }
            } else {
                $('.modal-content').html(this.badModal(`На вакансию уже откликнулись данные нельзя менять`)).after(() => this.modalCenter());
                setTimeout(() => this.modalClosing(), 1300);
            }
        });
    };
    setHandlers = () => {
        $(`#name_${this.id} p`).on('click', function (e) {
            e.preventDefault();
            $(this).closest('.accordion')
                .toggleClass('active');

            $(this).closest('.accordion')
                .find('.accordion-content')
                .stop()
                .slideToggle(500);
        });
        $(`#delete_${this.id}`).on('click', () => {
            $.ajax({
                type: "DELETE",
                url: `${baseUrl}/vacancies/${this.id}`
            }).done(() => {
                $(`#div_${this.id}`).slideUp(700);
            })
        });
        $(`#edit_${this.id}`).on('click', (e) => {
            e.preventDefault();
            this.vacancyModal.html(this.getModalMarkUp())
                .after(() => {
                    this.setModalValues();
                    this.setModalHandlers();
                });
            this.vacancyModalFon.addClass('active');
            this.vacancyModal.addClass('active');
            $('body').css('overflow', 'hidden');
        });
        this.resps.map(resp => {
            DirectorVacancy.respslength += 1;
            $(`#resp_${resp.response_id}`).on('click', (e) => {
                e.preventDefault();
                const me = this.resps.filter(x => x.response_id == resp.response_id)[0];
                const responder = new Responder(me.area_name, me.telefon, me.birthday, me.doljnost, me.dopinfo, me.email, me.surname, me.name, me.secondname, me.particip_staj, me.quality_name, me.response_comment, me.response_day, me.response_id);
                this.vacancyModal.html(responder.modalMarkUp())
                    .after(() => {
                        responder.setModalHandlers(this.modalClosing, this.deleteRespHandler);
                    });
                this.vacancyModalFon.addClass('active');
                this.vacancyModal.addClass('active');
                $('body').css('overflow', 'hidden');
            })
        })
    };
    deleteRespHandler = (id) => {
        $.ajax({
            type: "DELETE",
            url: `${baseUrl}/vacancy_responses/${id}`
        }).done(() => {
            $(`#li_${id}`).fadeOut(500);
            this.resps = this.resps.filter(x => x.response_id != id);
            $(`#resps_${this.id}`).text(this.resps.length);
            DirectorVacancy.respslength -= 1;
            $('#vacancy_count').text(getRightSting(DirectorVacancy.respslength));
            this.vacancyModalFon.removeClass("active");
            this.vacancyModal.removeClass("active");
            $('body').css('overflow', 'auto');
            setTimeout(() => this.vacancyModal.html(''), 500);
        })
    };
    renderDirectorSide = (blockId) => {
        let b = $(`<div class="accordion name" id="div_${this.id}" style="text-align: left; margin-top: 0.3rem"></div>`);
        b.append(this.getCardMarkUp());
        b.hide().appendTo(blockId).fadeIn(1500);
        this.setHandlers();
    }
}
