from PIL import Image, ImageFilter, ImageDraw, ImageChops
from datetime import datetime

startFullScript = datetime.now()

times = {
	'full_script': None, 
	'append_image': None, 
	'draw_lines': None, 
	'rotate': None, 
	'gaussian': None, 
}
memory = {
	'full_script': None, 
	'append_image': None, 
	'draw_lines': None, 
	'rotate': None, 
	'gaussian': None, 
}


def autocrop(im, bgcolor):
    if im.mode != "RGB":
        im = im.convert("RGB")
    
    bg = Image.new("RGB", im.size, bgcolor)
    diff = ImageChops.difference(im, bg)
    bbox = diff.getbbox()
    
    if bbox:
        return im.crop(bbox)
    
    return None


img = Image.open( '../images/im3.jpeg' )
im1 = Image.open("../images/im1.jpg")

im1 = im1.resize((700, 700), Image.ANTIALIAS)

imgW, imgH = img.size;
im1W, im1H = im1.size;

mask = Image.new('RGBA', (imgW, imgH), (0, 0, 0, 0))

startAppendImage = datetime.now()
img.paste(im1, (int((imgW / 2) - (im1W / 2)), int((imgH / 2) - (im1H / 2))))
times['append_image'] = datetime.now() - startAppendImage

draw = ImageDraw.Draw(img)
drawMask = ImageDraw.Draw(mask)

startDrawLines = datetime.now()
for i in range(0, imgH, 1):
	drawMask.line([(0, i), (imgW, i)], fill=(0, 0, 255, 66))

for i in range(0, imgW, 2):
	drawMask.line([(i, 0), (i, imgH)], fill=(255, 255, 255, 66))
times['draw_lines'] = datetime.now() - startDrawLines

img.paste(mask, (0, 0),  mask=mask)

startGaussian = datetime.now()
img = img.filter(ImageFilter.BLUR)
times['gaussian'] = datetime.now() - startGaussian

startRotate = datetime.now()
img=img.rotate(100, expand=True)
img=img.rotate(100, expand=True)
img=img.rotate(100, expand=True)
times['rotate'] = datetime.now() - startGaussian

img = autocrop(img, (0, 0, 0))

times['full_script'] = datetime.now() - startFullScript
img.save("pasted_picture.jpg") 

print(times)
