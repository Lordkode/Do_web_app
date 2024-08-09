import Axios from 'axios'
const axios = Axios.create({
  baseURL: 'http://localhost:8000',
  headers: {
    Accept: 'application/json',
    'Content-Type': 'application/json'
  },
  withCredentials: true
})

axios.interceptors.response.use(null, (err) => {
  const error = {
    status: err.response?.status,
    original: err,
    validation: {},
    message: null
  }

  if (err.response?.status === 422) {
    for (let field in err.response.data.errors) {
      error.validation[field] = err.response.data.errors[field][0]
    }
  } else {
    error.message = 'Something went wrong. Please try again later.'
  }

  return Promise.reject(error)
})

axios.interceptors.request.use(
  (config) => {
    config.headers['Authorization'] = `Bearer ${localStorage.getItem('token')}`
    return config
  },
  (error) => {
    return Promise.reject(error)
  }
)

export default axios
