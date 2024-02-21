import { Hono } from 'hono'
import { handle } from 'hono/cloudflare-pages'
import { Context } from "hono";
import * as CryptoJS from "crypto-js"

const app = new Hono().basePath('/api')

app.post('/v1/paymenizer/bill',async (c:Context)=>{
  const body = await c.req.json()
  const signature = c.req.header('X-HMAC-Signature') 

  const secret_key = '7Wd#SFV@N9^!DSf3P'
  var hash = CryptoJS.HmacSHA256(JSON.stringify(body), secret_key).toString();
  const msg = hash === signature ? 'TRUE' : 'FALSE'
  return c.json({msg},200)
})

app.get('/v1/paymenizer',async (c:Context)=>{
  
  return c.json({signature:'klklkl'},200)
})

export const onRequest = handle(app)