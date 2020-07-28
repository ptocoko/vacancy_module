class Vacancy {
    areaName;
    date;
    doljnost;
    typeDoljnost;
    schoolName;
    staj;
    zp;
    dopInfo;
    id;
    isShown = false;

    constructor(areaName, date, doljnost, typDoljnost, schoolName, staj, zp, dopInfo, id) {
        this.id = id;
        this.areaName = areaName.replace(' МР', '');
        this.date = date;
        this.doljnost = doljnost;
        this.typeDoljnost = typDoljnost;
        this.schoolName = schoolName;
        this.staj = staj;
        this.zp = zp;
        this.dopInfo = dopInfo;
        Vacancy.index++;
    }

    modalClosing = (modalBlock, modalFonBlock) => {
        modalFonBlock.removeClass("active");
        modalBlock.removeClass("active");
        $('body').css('overflow', 'auto');
        setTimeout(() => {
            modalBlock.html('')
        }, 450);
    };
    getDopInfo = () => this.dopInfo.length ? `<p class="mb-0"><b>Доп-ая информация</b>: <span>${this.dopInfo}</span>` : '';
    getDoljnost = () => this.typeDoljnost === '1' ? `Учитель ${this.doljnost}` : `${this.doljnost}`;
    getZp = () => this.zp === 'no' ? 'Не указана' : this.zp + ' &#8381;';
    getMarkUp = () => `<div class=" bg-white shadow-1" style="width: 360px; border-radius: 3px;">
                <div class="px-2 py-2"><p class="small font-weight-medium text-uppercase text-muted lts-2px">${this.date}</p>
                    <h1 class="ff-serif font-weight-normal text-black card-heading my-1" style="line-height: 1.25; font-size: 1.75rem;">
                    ${this.getDoljnost()}
                    </h1>
                    <p class="mb-1"><b>Район</b>: <span>${this.areaName.replace(' МР', '')}</span></p>
                    <p class="mb-1"><b>Школа</b>: <span>${this.schoolName}</span></p>
                    <p class="mb-1"><b>Зарпалата</b>: <span>${this.getZp()} </span></p>
                    <p class="mb-1"><b>Стаж работы</b>: <span>${this.staj}</span></p>
                </div>
            <a id="${this.id}" class="text-uppercase d-inline-block mb-1 font-weight-medium lts-2px text-center styled-link exit__btn"
               href="##">Подробнее</a>
            </div>`;
    modalMarkUp = () => {
        return `
            <a class="close-modal">
                <svg viewBox="0 0 20 20">
                    <path d="M15.898,4.045c-0.271-0.272-0.713-0.272-0.986,0l-4.71,4.711L5.493,4.045c-0.272-0.272-0.714-0.272-0.986,0s-0.272,0.714,0,0.986l4.709,4.711l-4.71,4.711c-0.272,0.271-0.272,0.713,0,0.986c0.136,0.136,0.314,0.203,0.492,0.203c0.179,0,0.357-0.067,0.493-0.203l4.711-4.711l4.71,4.711c0.137,0.136,0.314,0.203,0.494,0.203c0.178,0,0.355-0.067,0.492-0.203c0.273-0.273,0.273-0.715,0-0.986l-4.711-4.711l4.711-4.711C16.172,4.759,16.172,4.317,15.898,4.045z"
                          fill="#000000"></path>
                </svg>
            </a><!-- close modal -->
            <div class="modal-content" style="width: 100%;">
                <div class="my-2 mx-auto p-relative bg-white"
                     style="width: 100%; overflow: hidden; border-radius: 1px;">
                    <div class="px-2 py-2">
                        <p class="mb-0 small font-weight-medium text-uppercase mb-1 text-muted lts-2px">
                            ${this.date}</p>
                        <h1 class="ff-serif font-weight-normal text-black card-heading mt-0 mb-1"
                            style="line-height: 1.25;">
                            ${this.getDoljnost()}
                        </h1>
                        <p class="mb-1"><b>Район</b>: <span>${this.areaName}</span></p>
                        <p class="mb-1"><b>Школа</b>: <span>${this.schoolName}</span></p>
                        <p class="mb-1"><b>Зарпалата</b>: <span>${this.getZp()}</span></p>
                        <p class="mb-1"><b>Стаж работы</b>: <span>${this.staj}</span></p>
                        ${this.getDopInfo()}
                        </p>
                    </div>
                    </p>
                    <p class="mb-1" style="margin: 0; margin-top:7%;">
                        <a class="text-uppercase d-inline-block font-weight-medium lts-2px ml-2 mb-2 pb-2 text-center styled-link"
                           href="#0" id="otclick"
                           style="margin:0;">
                            Отозваться на вакансию
                        </a>
                    </p>
                </div>
            </div>
            <div class="modal_form">
                <form method="post">
                    <div class="base-box">
                        <p class="mb-1 mx-auto"><b>Сопроводительное письмо</b>:</p>
                        <textarea class="prof-box"
                                  cols="30"
                                  id="comment"
                                  name="comment"
                                  placeholder="Ваше сопроводительное письмо..."
                                  rows="10"></textarea>
                    </div>
                    <a class="mx-1 text-uppercase d-block font-weight-medium lts-2px text-center styled-link exit__btn"
                           id="send_vacancy_response"
                           value="${this.id}">
                           <i class="icon icon-message"></i>Отправить отзыв
                    </a>
                </form>
            </div>
            `;
    };

    modalCenter() {
        let blockCenter = [$('.modal').height() / 2, $('.modal').width() / 2];
        let contCenter = [$('#circle').height() / 2, ($('#circle').width() / 2)];
        let top = blockCenter[0] - contCenter[0];
        let left = blockCenter[1] - contCenter[1];
        $('#circle').css('top', top).css('left', left).css('visibility', 'visible');
    }

    okModal(text) {
        return `<div id="circle" style="position: fixed; visibility: hidden">
                    <svg class="checkmark" viewBox="0 0 52 52" xmlns="http://www.w3.org/2000/svg">
                        <circle class="checkmark__circle" cx="26" cy="26" fill="none" r="25"/>
                        <path class="checkmark__check" d="M14.1 27.2l7.1 7.2 16.7-16.8" fill="none"/>
                    </svg>
                    <p class="mb-0 small font-weight-medium text-uppercase mb-1 text-muted lts-2px" style="color: #7ac142;">${text}</p>
	            </div>`;
    }

    badModal(info) {
        return `<div id="circle" style="position: fixed; visibility: hidden">
                    <svg class="checkmark__x" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
                      <circle class="checkmark__circle__x" cx="26" cy="26" r="25" fill="none" />
                      <path class="checkmark__check__x" fill="none" d="M16 16 36 36 M36 16 16 36" />
                    </svg>
                    <p class="mb-0 small font-weight-medium text-uppercase mb-1 text-muted lts-2px" style="color: #d70707;">${info}</p>
                </div>`;
    }

    markUpHandlers = (modalBlock, modalFonBlock) => {
        $('#' + this.id).on('click', (e) => {
            e.preventDefault();
            $('body').css('overflow', 'hidden');
            modalFonBlock.addClass('active');
            modalBlock.html(this.modalMarkUp()).after(() => {
                modalBlock.addClass("active");
                $('.close-modal').on('click', () => this.modalClosing(modalBlock, modalFonBlock));
                $('#otclick').on('click', (e) => {
                    e.preventDefault();
                    $('.modal_form').slideToggle(600).after(() => {
                        $('#send_vacancy_response').on('click', e => {
                            $('.close-modal').off('click');
                            e.preventDefault();
                            $.post({
                                url: `${baseUrl}/vacancy_responses`,
                                data: {
                                    'vid': this.id,
                                    'comment': $('#comment').val()
                                }
                            }).fail((jqXHR, textStatus) => {
                                $('.modal_form').hide().after(() => {
                                    $('.modal-content').html(this.badModal(`Ошибка ${jqXHR.status} ${jqXHR.responseText}`))
                                        .after(() => {
                                            this.modalCenter();
                                        })
                                });
                                if (jqXHR.status === 401) {
                                    setTimeout(function () {
                                        window.location.href = "http://pedagogchr.ru/?openlogin=1";
                                    }, 2000)
                                } else {
                                    setTimeout(() => this.modalClosing(modalBlock, modalFonBlock), 1300)
                                }
                            }).done((data, textStatus, jqXHR) => {
                                if (jqXHR.status === 201) {
                                    $('.modal_form').hide().after(() => {
                                        $('.modal-content').html(this.okModal('Ваш отзыв на вакансию успешно отправлен'))
                                            .after(() => {
                                                this.modalCenter();
                                            });
                                        setTimeout(() => this.modalClosing(modalBlock, modalFonBlock), 1300)
                                    })
                                } else {
                                    $('.modal_form').hide().after(() => {
                                        $('.modal-content').html(this.badModal('Что-то пошло не так'))
                                            .after(() => {
                                                this.modalCenter();
                                            });
                                    });
                                    setTimeout(() => this.modalClosing(modalBlock, modalFonBlock), 1300)
                                }
                            });
                        })
                    });
                })
            })
        })
    };

    renderVacancyTeacherSide(block, baseId, modalBlock, modalFonBlock) {
        block.append(this.getMarkUp());
        block.hide().appendTo(baseId).slideDown(500);
        this.markUpHandlers(modalBlock, modalFonBlock);
        this.isShown = true;
    }
}



