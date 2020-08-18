const baseUrl = 'http://vacancy.test';
axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
const getAreas = async () => {
    const {data} = await axios.get(`${baseUrl}/areas`);
    return data;
};

const getParticipants = async (testid) => {
    const {data} = await axios.get(`${baseUrl}/particips/${testid}`);
    return data;
};

const getTest = async (yearId, subjectCode, particip) => {
    const {data} = await axios.get(`${baseUrl}/tests/get_by_selection?year=${yearId}&subject=${subjectCode}&particip=${particip}`);
    console.log(data);
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



