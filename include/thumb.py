#!/usr/bin/python
import os, sys
from PIL import ImageFile
import Image

def thumb(infile, ext):
	size = 250, 250
	outfile = os.path.splitext(infile)[0] + "_thumb" + ext
	types = {'.jpg' : 'JPEG', '.jpeg' : 'JPEG', '.png' : 'PNG', '.gif' : 'GIF'}
	im = Image.open(infile)
	im = im.convert('RGB')
	im.thumbnail(size, Image.ANTIALIAS)
	if ext.lower() == '.jpg' or ext.lower() == '.jpeg':
		try:
			im.save(outfile, types[ext.lower()], quality=80, optimize=True, progressive=True)
		except IOError:
			ImageFile.MAXBLOCK = im.size[0] * im.size[1]
			im.save(outfile, types[ext.lower()], quality=80, optimize=True, progressive=True)
	else:
		try:
			im.save(outfile, types[ext.lower()], quality=85)
		except IOError, e:
			print e

thumb(sys.argv[1], sys.argv[2])

