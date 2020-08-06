const areaElement = $('#base_areas');
const schoolElement = $('#base_schools');
const posElement = $('#base_dolj');
const payRangeSlider = $('#pay-range');
const modal = $('#real_vakansiya_modal');
const fon = $('#real_vakansiya_fon');
const more = $('#more');
const vacancyController = new VacancyController();
let areaId = 0;
let schoolId = 0;
let posId = 0;
let paymentValue = {min: 0, max: 0};
let stajid = 0;
let disable = false;

const localParams = typeof localStorage.params !== 'undefined' ? JSON.parse(localStorage.params) : {};
let params = (!$.isEmptyObject(localParams)) ? localParams : {
    dis: disable,
    ac: areaId,
    schid: schoolId,
    pid: posId,
    pmin: paymentValue.min,
    pmax: paymentValue.max,
    staid: stajid,
    page: vacancyController.counter
};
const CancelToken = axios.CancelToken;
let cancel;

async function sortVacancies() {
    cancel && cancel();
    if (areaId !== 0) {
        params = {...params, ac: areaId};
    }
    if (schoolId !== 0) {
        params = {...params, schid: schoolId};
    }
    if (posId !== 0) {
        params = {...params, pid: posId};
    }
    params = {...params, pmin: paymentValue.min, pmax: paymentValue.max};
    if (stajid !== 0) {
        params = {...params, staid: stajid};
    }
    if (vacancyController.counter !== params.page) {
        params = {...params, page: vacancyController.counter};
    }
    localStorage.params = JSON.stringify(params);
    const {data} = await axios.get(`${baseUrl}/vacancies/sort`, {
        cancelToken: new CancelToken(function executor(c) {
            cancel = c;
        }), params
    });
    return data;
}

vacancyController.modalBolck = modal;
vacancyController.modalFon = fon;

let loading = false;

async function renderVacancies() {
    loading = true;
    if (loading && $('#page_' + vacancyController.counter).html() !== '<div class="lds-dual-ring"></div>') {
        $('#page_' + vacancyController.counter).html('<div class="lds-dual-ring"></div>');
    }
    vacancyController.vacancyArray[vacancyController.counter] = [];
    sortVacancies().then(res => {
        loading = false;
        if (res.length >= 9) {
            more.fadeIn(500)
        }
        if (res.length < 9) {
            more.fadeOut(500);
        }
        if (res.length) {
            res.map(value => {
                vacancyController.vacancyArray[vacancyController.counter].push(
                    new Vacancy(value.areaname, value.date_insert, value.doljnost, value.doljtype, value.schoolname, value.staj, value.zp, value.dop_info, value.id)
                )
            });
            vacancyController.renderVacancies();
        }
        if (!res.length && vacancyController.counter === 0) {
            $('#vaca_cards').html('<div class="base-cards my-2 mx-1" id="page_0"><h1 class="text-center" style="flex:1 1 100%">Вакансий не найдено</h1></div>')
        }

    }).catch(e => {
    });

}

function setSchools(areaCode = 0) {
    schoolElement.html('<option selected value="0">Выберите школу</option>');
    if (areaCode == 0) {
        getSchools()
            .then(data => {
                data.map(x => {
                    schoolElement.append(`<option value="${x.id}">${x.name.trim()}</option>`)
                });
                schoolElement.val(params.schid);
                schoolElement.trigger('refresh');
            });
    } else {
        getSchoolsByArea(areaCode)
            .then(data => {
                data.map(x => {
                    schoolElement.append(`<option value="${x.id}">${x.name.trim()}</option>`);
                });
                schoolElement.val(params.schid);
                schoolElement.trigger('refresh');
            });
    }
}

getDoljnosti().then(res => {
    res.map(x => {
        posElement.append(x.typedoljnostid !== '1' ?
            `<option value="${x.id}">${x.name}</option>` :
            `<option value="${x.id}">Учитель ${x.name}</option>`
        );
    });
    posElement.val(params.pid);
    posElement.trigger('refresh')
});
getAreas().then(res => {
    res.map(x => {
        areaElement.append(`<option value="${x.Code}">${x.name.replace(' МР', '')}</option>`);
    });
    if (params.ac !== '0') {
        areaElement.val(params.ac);
        setSchools(parseInt(params.ac));
    }
    areaElement.trigger('refresh');
});
more.on('click', async () => {
    vacancyController.counter++;
    await renderVacancies();
});
areaElement.on('change', async (event) => {
    vacancyController.counter = 0;
    vacancyController.vacancyArray = [];
    areaId = event.target.value;
    schoolId = "0";
    if (areaId !== '0000') {
        setSchools(areaId);
    } else {
        setSchools();
    }
    await renderVacancies()
});
payRangeSlider.on('change', async (event) => {
    vacancyController.counter = 0;
    vacancyController.vacancyArray = [];
    let [min, max] = event.target.value.split(';');
    paymentValue.min = min;
    paymentValue.max = max;
    await renderVacancies();
});
payRangeSlider.ionRangeSlider({
    type: "double",
    skin: "round",
    min: 3000,
    max: 100000,
    step: 100,
    from: 5000,
    to: 25000,
    drag_interval: true,
    postfix: " &#8381;"
});
schoolElement.on('change', async (event) => {
    vacancyController.counter = 0;
    vacancyController.vacancyArray = [];
    schoolId = event.target.value;
    await renderVacancies();
});
posElement.on('change', async event => {
    vacancyController.counter = 0;
    vacancyController.vacancyArray = [];
    posId = event.target.value;
    await renderVacancies();
});
const payinstance = payRangeSlider.data("ionRangeSlider");
$(':radio[name="exp"]').on('change', async (event) => {
    vacancyController.counter = 0;
    vacancyController.vacancyArray = [];
    stajid = event.target.value;
    await renderVacancies();
});
$('#paymentCheck').on('change', async function (e) {
    vacancyController.counter = 0;
    vacancyController.vacancyArray = [];
    const disable = e.target.checked;
    params.dis = disable;
    if (disable) {
        paymentValue.max = 0;
        paymentValue.min = 0;
        await renderVacancies();
    } else {
        payRangeSlider.trigger('change');
    }
    payinstance.update({
        disable: disable,
    })

});
$(document).ready(() => {
    vacancyController.counter = 0;
    vacancyController.vacancyArray = [];
    if (!$.isEmptyObject(localParams)) {
        if (params.pmin > 0 && params.pmax > 0) {
            payinstance.update({
                from: params.pmin,
                to: params.pmax
            })
        } else {
            $('#paymentCheck').attr('checked', params.dis).trigger('change');
        }
        $(`#staj_${params.staid}`).attr('checked', true);
    }
    if (params.ac === '0') {
        setSchools();
    }
});
