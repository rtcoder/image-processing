package main

import (
	"image"
	"image/color"
	"log"

	"github.com/disintegration/imaging"
)

func main() {
	img, err := imaging.Open("../images/im3.jpeg")
	if err != nil {
		log.Fatalf("failed to open image: %v", err)
	}
	im1, err := imaging.Open("../images/im1.jeg")
	if err != nil {
		log.Fatalf("failed to open image: %v", err)
	}

	im1 = imaging.Resize(im1, 700, 700, imaging.Lanczos)
	log.Print(im1)
	img = imaging.Paste(img, img1, image.Pt(200, 200))

	img1 := imaging.Blur(img, 5)

	dst := imaging.New(400, 400, color.NRGBA{0, 0, 0, 0})

	err = imaging.Save(dst, "out_example.jpg")
	if err != nil {
		log.Fatalf("failed to save image: %v", err)
	}
}
