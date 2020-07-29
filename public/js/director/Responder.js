class Responder {
    areaName;
    birthday;
    doljnost;
    dopinfo;
    email;
    surname;
    name;
    secondName;
    staj;
    quality;
    comment;
    responseDay;
    id;
    participId;

    constructor(participId, areaName, telefon, birthday, doljnost, dopinfo, email, surname, name, secondName, staj, quality, comment, response_day, id, isAccepted) {
        this.participId = participId;
        this.id = id;
        this.telefon = telefon;
        this.areaName = areaName;
        this.birthday = birthday;
        this.doljnost = doljnost;
        this.dopinfo = dopinfo;
        this.email = email;
        this.surname = surname;
        this.name = name;
        this.secondName = secondName;
        this.staj = staj;
        this.quality = quality;
        this.comment = comment;
        this.responseDay = response_day;
        this.isAccepted = isAccepted;
        console.log(this.isAccepted)
    }

    getDopInfo = () => this.comment.length ? `<p class="mb-1"><b>Сопроводительное письмо</b>: <span>${this.comment}</span>` : '';
    getStaj = () => this.staj !== null ? `<p class="mb-1"><b>Стаж работы</b>: <span>${this.staj}</span>` : '';
    getQualityName = () => this.quality !== null ? `<p class="mb-1"><b>Квалификация</b>: <span>${this.quality}</span>` : '';
    getPhone = () => this.telefon !== '' ? `<p class="mb-1"><b>Телефон</b>: <span>${this.telefon}</span>` : '';
    getEmail = () => this.email !== '' ? `<p class="mb-1"><b>e-mail</b>: <span>${this.email}</span>` : '';
    getAccept = () => this.isAccepted == 0 ? ` <a class="text-uppercase d-block font-weight-medium lts-2px text-center styled-link accept__btn"
                               href="#0" id="accept">
                                Принять
                            </a>` : `<a href="${baseUrl}/gotodialog/${this.participId}" class="text-uppercase font-weight-medium lts-2px text-center styled-link accept__btn"><i class="fa fa-paper-plane" aria-hidden="true"></i></a>`;
    modalMarkUp = () => {
        return `<a class="close-modal" id="close_${this.id}">
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
                                ${this.responseDay}</p>
                            <h1 class="ff-serif font-weight-normal text-black card-heading mt-0 mb-1"
                                style="line-height: 1.25;">
                                ${this.surname} ${this.name} ${this.secondName}
                            </h1>
                            <p class="mb-1"><b>Дата рождения</b>: <span>${this.birthday}</span></p>
                            ${this.getStaj()}
                            ${this.getQualityName()}
                            <p class="mb-1"><b>Район проживания</b>: <span>${this.areaName}</span></p>
                            ${this.getDopInfo()}
                            ${this.getPhone()}
                            ${this.getEmail()}
                            </p>
                        </div>
                        </p>
                        <div style="display: flex;justify-content: space-evenly">
                            ${this.getAccept()}
                            <a class="text-uppercase d-block font-weight-medium lts-2px text-center styled-link exit__btn"
                               href="#0" id="exit">
                                Закрыть
                            </a>
                             <a class="text-uppercase btn--light  d-block font-weight-medium lts-2px styled-link cancel__btn"
                               href="#0" id="delete">
                                Отклонить
                            </a>
                        </div>
                    </div>
                </div>
                `
    };
    setModalHandlers = (modalClosing, deleting, accepting) => {
        $(`#close_${this.id}`).on('click', () => modalClosing());
        $('#exit').on('click', () => modalClosing());
        $('#delete').on('click', () => deleting(this.id));
        $('#accept').on('click', () => accepting(this.participId, this.id))
    }
}