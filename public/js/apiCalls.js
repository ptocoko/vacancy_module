const baseUrl = 'http://vacancy.test';
axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
const getAreas = async () => {
    const {data} = await axios.get(`${baseUrl}/areas`);
    return data;
};

const getDialogs = async () => {
    const {data} = await axios.get(`${baseUrl}/dialogs`);
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
    const {data} = await axios.get(`${baseUrl}/vacancies/by_school`);
    return data;
}



