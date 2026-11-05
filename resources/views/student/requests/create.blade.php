
@extends('layouts.student')

@section('title', 'Service Requests')
@section('page_title', 'Service Requests')

@section('content')

<style>
    .request-create-page {
        max-width: 820px;
        margin: 0 auto;
        color: #172033;
    }

    .request-create-page * {
        box-sizing: border-box;
    }

    .request-create-page .page-heading {
        margin-bottom: 24px;
    }

    .request-create-page .eyebrow {
        display: block;
        margin-bottom: 9px;
        color: #527fa5;
        font-size: 11px;
        font-weight: 800;
        letter-spacing: 1.3px;
        text-transform: uppercase;
    }

    .request-create-page h1 {
        margin: 0 0 9px;
        font-size: 27px;
        letter-spacing: -.6px;
        color: #172b40;
    }

    .request-create-page .intro {
        margin: 0;
        color: #64748b;
        font-size: 13px;
        line-height: 1.7;
    }

    .request-create-page .request-card {
        background: #fff;
        border: 1px solid #e5e9f0;
        border-radius: 12px;
        padding: 30px;
        box-shadow: 0 5px 20px rgba(20,35,60,.04);
    }

    .request-create-page .form-group {
        margin-bottom: 23px;
    }

    .request-create-page .form-group label {
        display: block;
        margin-bottom: 9px;
        font-size: 13px;
        font-weight: 650;
        color: #253750;
    }

    .request-create-page .form-control {
        width: 100%;
        padding: 13px 14px;
        border: 1px solid #d8e0eb;
        border-radius: 8px;
        background: #fff;
        color: #172033;
        font: inherit;
        font-size: 13px;
        outline: none;
        transition: border-color .2s, box-shadow .2s;
    }

    .request-create-page .form-control:focus {
        border-color: #527fa5;
        box-shadow: 0 0 0 3px rgba(82,127,165,.12);
    }

    .request-create-page textarea.form-control {
        min-height: 155px;
        resize: vertical;
        line-height: 1.6;
    }

    .request-create-page .hint {
        margin: 8px 0 0;
        color: #8490a2;
        font-size: 11px;
    }

    .request-create-page .field-error {
        margin: 7px 0 0;
        color: #c0392b;
        font-size: 12px;
    }

    .request-create-page .alert-error {
        padding: 13px 15px;
        margin-bottom: 22px;
        border: 1px solid #f3cccc;
        border-radius: 8px;
        background: #fff0f0;
        color: #a52a2a;
        font-size: 13px;
    }

    .request-create-page .form-actions {
        display: flex;
        justify-content: flex-end;
        gap: 11px;
        margin-top: 28px;
        padding-top: 23px;
        border-top: 1px solid #edf0f5;
    }

    .request-create-page .btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 12px 19px;
        border: none;
        border-radius: 8px;
        font: inherit;
        font-size: 13px;
        font-weight: 650;
        text-decoration: none;
        cursor: pointer;
        transition: background .2s;
    }

    .request-create-page .btn-secondary {
        background: #eef1f6;
        color: #344054;
    }

    .request-create-page .btn-secondary:hover {
        background: #e2e7ee;
    }

    .request-create-page .btn-primary {
        background: #193653;
        color: white;
    }

    .request-create-page .btn-primary:hover {
        background: #10243e;
    }

    @media (max-width: 600px) {
        .request-create-page .request-card {
            padding: 20px;
        }

        .request-create-page h1 {
            font-size: 23px;
        }

        .request-create-page .form-actions {
            flex-direction: column-reverse;
        }

        .request-create-page .btn {
            width: 100%;
        }
    }
</style>

<div class="request-create-page">

    <div class="page-heading">
        <span class="eyebrow">Student Services</span>

        <h1>New Service Request</h1>

        <p class="intro">
            Submit your concern or request below.
            Please provide clear information so the appropriate
            staff can review it.
        </p>
    </div>

    <section class="request-card">

        @if ($errors->any())
            <div class="alert-error" role="alert">
                Please check the information you entered and try again.
            </div>
        @endif

        <form action="{{ route('student.requests.store') }}"
              method="POST">
            @csrf

            <div class="form-group">
                <label for="category">Request Category</label>

                <select id="category"
                        name="category"
                        class="form-control"
                        required>
                    <option value="">Select a category</option>

                    @foreach ([
                        'General Inquiry',
                        'Document Request',
                        'Technical Support',
                        'Student Support',
                        'Facilities/Maintenance'
                    ] as $category)
                        <option value="{{ $category }}"
                            {{ old('category') === $category ? 'selected' : '' }}>
                            {{ $category }}
                        </option>
                    @endforeach
                </select>

                @error('category')
                    <p class="field-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="subject">Subject</label>

                <input
                    type="text"
                    id="subject"
                    name="subject"
                    class="form-control"
                    maxlength="150"
                    value="{{ old('subject') }}"
                    placeholder="Enter a short subject"
                    required
                >

                @error('subject')
                    <p class="field-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="description">Description</label>

                <textarea
                    id="description"
                    name="description"
                    class="form-control"
                    maxlength="2000"
                    placeholder="Explain your concern or request..."
                    required
                >{{ old('description') }}</textarea>

                <p class="hint">Maximum of 2,000 characters.</p>

                @error('description')
                    <p class="field-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-actions">
                <a href="{{ route('dashboard') }}"
                   class="btn btn-secondary">
                    Cancel
                </a>

                <button type="submit" class="btn btn-primary">
                    Submit Request
                </button>
            </div>

        </form>
    </section>

</div>

@endsection
