import axios from 'axios'

let headers = {
  'Accept': 'application/json',
  'Content-Type': 'application/json'
}

const instance = axios.create({
  baseURL: process.env.MIX_APP_API_URL,
  headers,
})

export default instance;