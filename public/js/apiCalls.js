const baseUrl = 'http://vacancy.test';
const getAreas = async () => {
    const {data} = await axios.get(`${baseUrl}/areas`);
    return data;
};
const getSchoolsByArea = async (areaCode) => {
    const {data} = await axios.get(`${baseUrl}/areas/${areaCode}/schools`);
    return data;
};
const getSchools = async () => {
    const {data} = await axios.get(`${baseUrl}/schools`);
    return data;
};

async function getDoljnosti() {
    const {data} = await axios.get(`${baseUrl}/positions`);
    return data;
}

async function getVacanciesBySchoolId() {
    const {data} = await axios.get(`${baseUrl}/vacancies/getbyschool`);
    return data;
}

function badModal(info) {
    return `
<a class="close-modal">
	<svg viewBox="0 0 20 20">
		<path d="M15.898,4.045c-0.271-0.272-0.713-0.272-0.986,0l-4.71,4.711L5.493,4.045c-0.272-0.272-0.714-0.272-0.986,0s-0.272,0.714,0,0.986l4.709,4.711l-4.71,4.711c-0.272,0.271-0.272,0.713,0,0.986c0.136,0.136,0.314,0.203,0.492,0.203c0.179,0,0.357-0.067,0.493-0.203l4.711-4.711l4.71,4.711c0.137,0.136,0.314,0.203,0.494,0.203c0.178,0,0.355-0.067,0.492-0.203c0.273-0.273,0.273-0.715,0-0.986l-4.711-4.711l4.711-4.711C16.172,4.759,16.172,4.317,15.898,4.045z"
		      fill="#000000"></path>
	</svg>
</a>
<div class="modal-content" style="width: 100%;">
<div id="circle" style="position: fixed; visibility: hidden">
<svg class="checkmark__x" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
  <circle class="checkmark__circle__x" cx="26" cy="26" r="25" fill="none" />
  <path class="checkmark__check__x" fill="none" d="M16 16 36 36 M36 16 16 36" />
</svg>
<p class="mb-0 small font-weight-medium text-uppercase mb-1 text-muted lts-2px" style="color: #d70707;">${info}</p>
</div>
</div>
`;
}



