import { revalidateTag } from 'next/cache'
import { NextRequest, NextResponse } from 'next/server'

export async function POST(request: NextRequest) {
  try {
    const body = await request.json()
    
    // Verify webhook secret
    const secret = request.headers.get('x-sanity-webhook-secret')
    if (secret !== process.env.SANITY_WEBHOOK_SECRET) {
      return NextResponse.json(
        { message: 'Invalid secret' },
        { status: 401 }
      )
    }
    
    // Revalidate based on document type
    const { _type } = body
    
    switch (_type) {
      case 'project':
        revalidateTag('projects', 'max')
        break
      case 'service':
        revalidateTag('services', 'max')
        break
      case 'siteSettings':
        revalidateTag('settings', 'max')
        break
      default:
        revalidateTag('content', 'max')
    }
    
    return NextResponse.json({ revalidated: true })
  } catch (error) {
    return NextResponse.json(
      { message: 'Error revalidating' },
      { status: 500 }
    )
  }
}